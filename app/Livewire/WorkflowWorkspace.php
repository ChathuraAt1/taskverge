<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Workflow Workspace')]
class WorkflowWorkspace extends Component
{
    public Workflow $workflow;

    public string $viewMode = 'kanban'; // kanban, list

    public string $search = '';

    public string $priorityFilter = 'all';

    public string $assigneeFilter = 'all';

    public string $statusFilter = 'all';

    // New task modal fields
    public bool $showCreateTaskModal = false;

    public string $newTaskTitle = '';

    public string $newTaskDescription = '';

    public string $newTaskPriority = 'medium';

    public ?int $newTaskStageId = null;

    public ?int $newTaskAssigneeId = null;

    public ?string $newTaskDeadline = null;

    public ?float $newTaskEstimatedHours = null;

    public string $newTaskTagsInput = '';

    // Task Detail & Edit Modal fields
    public bool $showTaskModal = false;

    public ?Task $selectedTask = null;

    public string $editTitle = '';

    public string $editDescription = '';

    public string $editPriority = 'medium';

    public string $editStatus = 'pending';

    public ?int $editStageId = null;

    public ?int $editAssigneeId = null;

    public ?string $editDeadline = null;

    public ?string $editBlockedReason = null;

    public ?float $editEstimatedHours = null;

    public ?float $editActualHours = null;

    // Add note / audit comment in task detail modal
    public string $newAuditNote = '';

    // Block Task Modal
    public bool $showBlockModal = false;

    public ?int $blockingTaskId = null;

    public string $blockReason = '';

    public function mount(Workflow $workflow): void
    {
        $this->workflow = $workflow->load(['stages.tasks.assignee', 'owner']);
        $firstStage = $this->workflow->stages->first();
        if ($firstStage) {
            $this->newTaskStageId = $firstStage->id;
        }
    }

    public function setViewMode(string $mode): void
    {
        $this->viewMode = in_array($mode, ['kanban', 'list'], true) ? $mode : 'kanban';
    }

    public function openCreateTaskModal(?int $stageId = null): void
    {
        $this->reset([
            'newTaskTitle',
            'newTaskDescription',
            'newTaskPriority',
            'newTaskDeadline',
            'newTaskEstimatedHours',
            'newTaskTagsInput',
        ]);
        $this->newTaskPriority = 'medium';
        $this->newTaskStageId = $stageId ?? $this->workflow->stages->first()?->id;
        $this->newTaskAssigneeId = null;
        $this->showCreateTaskModal = true;
    }

    public function closeCreateTaskModal(): void
    {
        $this->showCreateTaskModal = false;
    }

    public function createTask(): void
    {
        $this->validate([
            'newTaskTitle' => ['required', 'string', 'min:3', 'max:255'],
            'newTaskPriority' => ['required', 'in:low,medium,high,critical'],
            'newTaskStageId' => ['required', 'exists:workflow_stages,id'],
            'newTaskAssigneeId' => ['nullable', 'exists:users,id'],
            'newTaskDeadline' => ['nullable', 'date'],
            'newTaskEstimatedHours' => ['nullable', 'numeric', 'min:0'],
        ]);

        $stage = WorkflowStage::findOrFail($this->newTaskStageId);

        // Generate unique enterprise task number
        $lastId = Task::max('id') ?? 0;
        $taskNumber = 'TSK-'.str_pad((string) ($lastId + 1), 4, '0', STR_PAD_LEFT);

        // Parse tags
        $tags = array_filter(array_map('trim', explode(',', $this->newTaskTagsInput)));

        $status = 'pending';
        if ($stage->is_terminal_success) {
            $status = 'completed';
        } elseif ($stage->is_blocked_stage) {
            $status = 'blocked';
        } elseif ($stage->order > 1) {
            $status = 'active';
        }

        $task = Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $stage->id,
            'task_number' => $taskNumber,
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription,
            'priority' => $this->newTaskPriority,
            'status' => $status,
            'deadline' => $this->newTaskDeadline ? date('Y-m-d H:i:s', strtotime($this->newTaskDeadline)) : null,
            'assigned_to' => $this->newTaskAssigneeId,
            'created_by' => Auth::id(),
            'estimated_hours' => $this->newTaskEstimatedHours,
            'tags' => array_values($tags),
            'order_column' => ($stage->tasks()->max('order_column') ?? 0) + 1,
        ]);

        $task->recordActivity(
            'created',
            "Task {$task->task_number} created by ".Auth::user()->name." at stage '{$stage->name}'",
            null,
            Auth::user()
        );

        if ($task->assigned_to && $task->assignee) {
            $task->recordActivity(
                'assigned',
                "Assigned to {$task->assignee->name}",
                ['assignee' => $task->assignee->name],
                Auth::user()
            );
        }

        $this->showCreateTaskModal = false;
        session()->flash('status', "Task {$task->task_number} created successfully.");
    }

    /**
     * Move task to another stage.
     */
    public function moveTaskToStage(int $taskId, int $targetStageId): void
    {
        $task = Task::findOrFail($taskId);
        $targetStage = WorkflowStage::findOrFail($targetStageId);

        if ($targetStage->is_blocked_stage) {
            // Need a reason to block
            $this->blockingTaskId = $taskId;
            $this->blockReason = '';
            $this->showBlockModal = true;

            return;
        }

        $oldStageName = $task->stage->name;
        $oldStatus = $task->status;

        $newStatus = $task->status;
        if ($targetStage->is_terminal_success) {
            $newStatus = 'completed';
        } elseif ($task->status === 'blocked') {
            $newStatus = 'active';
        } elseif ($targetStage->order > 1 && $task->status === 'pending') {
            $newStatus = 'active';
        }

        $task->update([
            'stage_id' => $targetStage->id,
            'status' => $newStatus,
            'blocked_reason' => null,
        ]);

        $task->recordActivity(
            'stage_moved',
            "Moved from '{$oldStageName}' to '{$targetStage->name}' by ".Auth::user()->name,
            ['from_stage' => $oldStageName, 'to_stage' => $targetStage->name],
            Auth::user()
        );

        if ($newStatus !== $oldStatus) {
            $task->recordActivity(
                'status_changed',
                "Status shifted from '{$oldStatus}' to '{$newStatus}'",
                ['old_status' => $oldStatus, 'new_status' => $newStatus],
                Auth::user()
            );
        }

        session()->flash('status', "Task {$task->task_number} moved to {$targetStage->name}.");
    }

    /**
     * Submit block task with reason.
     */
    public function confirmBlockTask(): void
    {
        $this->validate([
            'blockReason' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        if (! $this->blockingTaskId) {
            return;
        }

        $task = Task::findOrFail($this->blockingTaskId);
        $blockedStage = $this->workflow->stages()->where('is_blocked_stage', true)->first();

        $task->update([
            'status' => 'blocked',
            'stage_id' => $blockedStage ? $blockedStage->id : $task->stage_id,
            'blocked_reason' => $this->blockReason,
        ]);

        $task->recordActivity(
            'blocked',
            'Task flagged as Blocked by '.Auth::user()->name.": {$this->blockReason}",
            ['reason' => $this->blockReason],
            Auth::user()
        );

        $this->showBlockModal = false;
        $this->blockingTaskId = null;
        $this->blockReason = '';

        session()->flash('status', "Task {$task->task_number} flagged as blocked.");
    }

    public function closeBlockModal(): void
    {
        $this->showBlockModal = false;
        $this->blockingTaskId = null;
        $this->blockReason = '';
    }

    /**
     * Inspect and edit task details.
     */
    public function openTaskModal(int $taskId): void
    {
        $this->selectedTask = Task::with(['workflow.stages', 'stage', 'assignee', 'creator', 'activities.user'])->findOrFail($taskId);
        $this->editTitle = $this->selectedTask->title;
        $this->editDescription = $this->selectedTask->description ?? '';
        $this->editPriority = $this->selectedTask->priority;
        $this->editStatus = $this->selectedTask->status;
        $this->editStageId = $this->selectedTask->stage_id;
        $this->editAssigneeId = $this->selectedTask->assigned_to;
        $this->editDeadline = $this->selectedTask->deadline ? $this->selectedTask->deadline->format('Y-m-d') : null;
        $this->editBlockedReason = $this->selectedTask->blocked_reason ?? '';
        $this->editEstimatedHours = $this->selectedTask->estimated_hours;
        $this->editActualHours = $this->selectedTask->actual_hours;
        $this->newAuditNote = '';
        $this->showTaskModal = true;
    }

    public function closeTaskModal(): void
    {
        $this->showTaskModal = false;
        $this->selectedTask = null;
    }

    /**
     * Save edited task details.
     */
    public function updateTask(): void
    {
        if (! $this->selectedTask) {
            return;
        }

        $this->validate([
            'editTitle' => ['required', 'string', 'min:3', 'max:255'],
            'editPriority' => ['required', 'in:low,medium,high,critical'],
            'editStatus' => ['required', 'in:pending,active,blocked,completed'],
            'editStageId' => ['required', 'exists:workflow_stages,id'],
            'editAssigneeId' => ['nullable', 'exists:users,id'],
            'editDeadline' => ['nullable', 'date'],
            'editEstimatedHours' => ['nullable', 'numeric', 'min:0'],
            'editActualHours' => ['nullable', 'numeric', 'min:0'],
        ]);

        $task = $this->selectedTask;

        // Check and audit changed attributes
        if ($task->priority !== $this->editPriority) {
            $task->recordActivity(
                'priority_changed',
                "Priority modified from {$task->priority} to {$this->editPriority} by ".Auth::user()->name,
                ['old' => $task->priority, 'new' => $this->editPriority],
                Auth::user()
            );
        }

        if ($task->assigned_to !== $this->editAssigneeId) {
            $newAssignee = $this->editAssigneeId ? User::find($this->editAssigneeId) : null;
            $task->recordActivity(
                'assigned',
                'Reassigned to '.($newAssignee ? $newAssignee->name : 'Unassigned').' by '.Auth::user()->name,
                ['assignee' => $newAssignee?->name],
                Auth::user()
            );
        }

        if ($task->status !== $this->editStatus) {
            $task->recordActivity(
                'status_changed',
                "Status updated to {$this->editStatus} by ".Auth::user()->name,
                ['old' => $task->status, 'new' => $this->editStatus],
                Auth::user()
            );
        }

        if ($task->stage_id !== (int) $this->editStageId) {
            $targetStage = WorkflowStage::find($this->editStageId);
            $task->recordActivity(
                'stage_moved',
                "Stage advanced to '{$targetStage?->name}' by ".Auth::user()->name,
                ['target_stage' => $targetStage?->name],
                Auth::user()
            );
        }

        $task->update([
            'title' => $this->editTitle,
            'description' => $this->editDescription,
            'priority' => $this->editPriority,
            'status' => $this->editStatus,
            'stage_id' => $this->editStageId,
            'assigned_to' => $this->editAssigneeId,
            'deadline' => $this->editDeadline ? date('Y-m-d H:i:s', strtotime($this->editDeadline)) : null,
            'blocked_reason' => $this->editStatus === 'blocked' ? $this->editBlockedReason : null,
            'estimated_hours' => $this->editEstimatedHours,
            'actual_hours' => $this->editActualHours ?? 0,
        ]);

        $this->selectedTask = $task->fresh(['workflow.stages', 'stage', 'assignee', 'creator', 'activities.user']);
        session()->flash('status', "Task {$task->task_number} successfully updated.");
    }

    /**
     * Append a note/comment to the audit history.
     */
    public function addAuditNote(): void
    {
        $this->validate([
            'newAuditNote' => ['required', 'string', 'min:3', 'max:500'],
        ]);

        if (! $this->selectedTask) {
            return;
        }

        $this->selectedTask->recordActivity(
            'note_added',
            Auth::user()->name.': '.$this->newAuditNote,
            ['note' => $this->newAuditNote],
            Auth::user()
        );

        $this->newAuditNote = '';
        $this->selectedTask = $this->selectedTask->fresh(['workflow.stages', 'stage', 'assignee', 'creator', 'activities.user']);
    }

    public function render()
    {
        $stages = $this->workflow->stages()->orderBy('order')->get();
        $assignees = User::query()->where('is_active', true)->get();

        // Build filtered tasks collection
        $tasksQuery = Task::query()
            ->where('workflow_id', $this->workflow->id)
            ->with(['stage', 'assignee']);

        if ($this->search) {
            $tasksQuery->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('task_number', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->priorityFilter !== 'all') {
            $tasksQuery->where('priority', $this->priorityFilter);
        }

        if ($this->assigneeFilter !== 'all') {
            if ($this->assigneeFilter === 'unassigned') {
                $tasksQuery->whereNull('assigned_to');
            } else {
                $tasksQuery->where('assigned_to', $this->assigneeFilter);
            }
        }

        if ($this->statusFilter !== 'all') {
            if ($this->statusFilter === 'overdue') {
                $tasksQuery->overdue();
            } else {
                $tasksQuery->where('status', $this->statusFilter);
            }
        }

        $allTasks = $tasksQuery->orderBy('order_column')->get();

        // Group tasks by stage for Kanban view
        $stageTasks = [];
        foreach ($stages as $stage) {
            $stageTasks[$stage->id] = $allTasks->where('stage_id', $stage->id);
        }

        return view('livewire.workflow-workspace', [
            'stages' => $stages,
            'assignees' => $assignees,
            'stageTasks' => $stageTasks,
            'allTasks' => $allTasks,
        ]);
    }
}
