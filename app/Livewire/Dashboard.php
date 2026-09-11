<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskActivity;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use App\Services\CortexAiService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public ?int $selectedTaskId = null;
    public ?Task $selectedTask = null;
    public bool $showTaskModal = false;
    public string $taskFilter = 'active';

    // 1. Quick Task Creator state
    public bool $showCreateTaskModal = false;
    public string $newTaskTitle = '';
    public ?int $newTaskWorkflowId = null;
    public ?int $newTaskStageId = null;
    public string $newTaskPriority = 'medium';
    public ?int $newTaskAssigneeId = null;
    public string $newTaskDeadline = '';
    public float $newTaskEstimatedHours = 4.0;
    public string $newTaskDescription = '';
    public string $newTaskTagsInput = '';
    public ?array $aiTriageResult = null;
    public bool $isAnalyzingAi = false;

    // 2. SLA Radar & AI Blocker Analysis
    public array $aiBlockerAnalyses = [];
    public ?int $analyzingBlockerId = null;

    // 7. Standup Report state
    public bool $showStandupModal = false;
    public string $standupMarkdown = '';
    public bool $isGeneratingStandup = false;

    public function mount(): void
    {
        $firstWorkflow = Workflow::first();
        if ($firstWorkflow) {
            $this->newTaskWorkflowId = $firstWorkflow->id;
            $firstStage = $firstWorkflow->stages()->first();
            $this->newTaskStageId = $firstStage ? $firstStage->id : null;
        }
        $this->newTaskAssigneeId = Auth::id();
    }

    public function updatedNewTaskWorkflowId($value): void
    {
        if ($value) {
            $workflow = Workflow::find($value);
            $stage = $workflow?->stages()->first();
            $this->newTaskStageId = $stage ? $stage->id : null;
        }
    }

    /**
     * Trigger Cortex AI to suggest task triage (priority, hours, tags).
     */
    public function aiSuggestTriage(): void
    {
        if (empty(trim($this->newTaskTitle))) {
            session()->flash('triage_error', 'Please enter a task title first.');
            return;
        }

        $this->isAnalyzingAi = true;
        $ai = app(CortexAiService::class);
        $result = $ai->suggestTriage($this->newTaskTitle, $this->newTaskDescription);

        $this->newTaskPriority = $result['priority'];
        $this->newTaskEstimatedHours = (float) $result['estimated_hours'];
        if (!empty($result['suggested_tags'])) {
            $this->newTaskTagsInput = implode(', ', $result['suggested_tags']);
        }
        $this->aiTriageResult = $result;
        $this->isAnalyzingAi = false;
    }

    /**
     * Save newly created quick task.
     */
    public function saveQuickTask(): void
    {
        $this->validate([
            'newTaskTitle' => ['required', 'string', 'max:255'],
            'newTaskWorkflowId' => ['required', 'exists:workflows,id'],
            'newTaskStageId' => ['required', 'exists:workflow_stages,id'],
            'newTaskPriority' => ['required', 'in:low,medium,high,critical'],
            'newTaskAssigneeId' => ['nullable', 'exists:users,id'],
            'newTaskDeadline' => ['nullable', 'date'],
            'newTaskEstimatedHours' => ['required', 'numeric', 'min:0.5', 'max:500'],
        ]);

        $stage = WorkflowStage::findOrFail($this->newTaskStageId);

        // Generate unique enterprise task number
        $lastId = Task::max('id') ?? 0;
        $taskNumber = 'TSK-' . str_pad((string) ($lastId + 1), 4, '0', STR_PAD_LEFT);

        $tags = array_filter(array_map('trim', explode(',', $this->newTaskTagsInput)));

        $status = 'active';
        if ($stage->is_terminal_success) {
            $status = 'completed';
        } elseif ($stage->is_blocked_stage) {
            $status = 'blocked';
        }

        $task = Task::create([
            'workflow_id' => $this->newTaskWorkflowId,
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
            "Task {$task->task_number} created from Dashboard by " . Auth::user()->name,
            ['stage' => $stage->name, 'priority' => $task->priority]
        );

        $this->closeCreateTaskModal();
        session()->flash('status', "Task {$task->task_number} created successfully.");
    }

    public function openCreateTaskModal(): void
    {
        $this->reset(['newTaskTitle', 'newTaskDescription', 'newTaskTagsInput', 'aiTriageResult']);
        $this->newTaskPriority = 'medium';
        $this->newTaskEstimatedHours = 4.0;
        $this->newTaskAssigneeId = Auth::id();
        $this->showCreateTaskModal = true;
    }

    public function closeCreateTaskModal(): void
    {
        $this->showCreateTaskModal = false;
        $this->aiTriageResult = null;
    }

    /**
     * Analyze a blocked task using Cortex AI.
     */
    public function aiAnalyzeBlocker(int $taskId): void
    {
        $this->analyzingBlockerId = $taskId;
        $task = Task::with(['workflow', 'stage'])->findOrFail($taskId);
        $ai = app(CortexAiService::class);
        $this->aiBlockerAnalyses[$taskId] = $ai->analyzeBlocker($task);
        $this->analyzingBlockerId = null;
    }

    /**
     * Generate 1-Click AI Daily Standup report.
     */
    public function openStandupModal(): void
    {
        $this->isGeneratingStandup = true;
        $this->showStandupModal = true;

        $user = Auth::user();
        $activeTasks = Task::with('workflow')->where('assigned_to', $user->id)->where('status', 'active')->get();
        $blockedTasks = Task::with('workflow')->where('assigned_to', $user->id)->where('status', 'blocked')->get();
        $completedTasks = Task::with('workflow')->where('assigned_to', $user->id)->where('status', 'completed')->where('updated_at', '>=', now()->subDays(7))->get();

        $ai = app(CortexAiService::class);
        $this->standupMarkdown = $ai->generateStandupSummary($user, $activeTasks, $completedTasks, $blockedTasks);
        $this->isGeneratingStandup = false;
    }

    public function closeStandupModal(): void
    {
        $this->showStandupModal = false;
        $this->standupMarkdown = '';
    }

    /**
     * Export tasks to CSV.
     */
    public function exportTasksCsv(): StreamedResponse
    {
        $user = Auth::user();
        $tasks = Task::with(['workflow', 'stage', 'assignee'])
            ->where('assigned_to', $user->id)
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="taskverge-tasks-' . date('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($tasks) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Task Number', 'Title', 'Workflow', 'Stage', 'Status', 'Priority', 'Deadline', 'Estimated Hours', 'Actual Hours']);

            foreach ($tasks as $task) {
                fputcsv($handle, [
                    $task->task_number,
                    $task->title,
                    $task->workflow?->name ?? 'N/A',
                    $task->stage?->name ?? 'N/A',
                    ucfirst($task->status),
                    ucfirst($task->priority),
                    $task->deadline ? $task->deadline->format('Y-m-d H:i') : 'No deadline',
                    $task->estimated_hours ?? 0,
                    $task->actual_hours ?? 0,
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Quick mark task as completed.
     */
    public function completeTask(int $taskId): void
    {
        $task = Task::findOrFail($taskId);
        $terminalStage = $task->workflow->completedStage() ?? $task->workflow->stages()->latest('order')->first();

        $task->update([
            'status' => 'completed',
            'stage_id' => $terminalStage ? $terminalStage->id : $task->stage_id,
            'blocked_reason' => null,
        ]);

        $task->recordActivity(
            'status_changed',
            'Marked completed from Dashboard',
            ['status' => 'completed']
        );

        session()->flash('status', "'{$task->title}' marked as completed.");
    }

    /**
     * Quick unblock a task.
     */
    public function unblockTask(int $taskId): void
    {
        $task = Task::findOrFail($taskId);
        $oldStatus = $task->status;

        $activeStage = $task->workflow->stages()
            ->where('is_blocked_stage', false)
            ->where('is_terminal_success', false)
            ->first();

        $task->update([
            'status' => 'active',
            'stage_id' => $activeStage ? $activeStage->id : $task->stage_id,
            'blocked_reason' => null,
        ]);

        $task->recordActivity(
            'unblocked',
            'Unblocked from Dashboard by ' . Auth::user()->name,
            ['previous_status' => $oldStatus]
        );

        session()->flash('status', "'{$task->title}' has been unblocked.");
    }

    /**
     * Open task detail modal.
     */
    public function inspectTask(int $taskId): void
    {
        $this->selectedTaskId = $taskId;
        $this->selectedTask = Task::with(['workflow', 'stage', 'assignee', 'creator', 'activities.user'])->findOrFail($taskId);
        $this->showTaskModal = true;
    }

    public function closeTaskModal(): void
    {
        $this->showTaskModal = false;
        $this->selectedTaskId = null;
        $this->selectedTask = null;
    }

    public function render()
    {
        $user = Auth::user();

        // 1. Personal Task Counts
        $myActiveTasks = Task::where('assigned_to', $user->id)->whereIn('status', ['active', 'pending'])->count();
        $myNeedsAttention = Task::where('assigned_to', $user->id)
            ->where(function ($q) {
                $q->where('status', 'blocked')
                  ->orWhere(function ($sq) {
                      $sq->where('status', '!=', 'completed')
                         ->whereNotNull('deadline')
                         ->where('deadline', '<', now());
                  });
            })->count();
        $myCompletedThisWeek = Task::where('assigned_to', $user->id)
            ->where('status', 'completed')
            ->where('updated_at', '>=', now()->startOfWeek())
            ->count();

        // 2. Personal Velocity Telemetry
        $allUserCompleted = Task::where('assigned_to', $user->id)->where('status', 'completed')->get();
        $totalCompletedCount = $allUserCompleted->count();
        $onTimeCount = $allUserCompleted->filter(fn($t) => !$t->deadline || $t->updated_at <= $t->deadline)->count();
        $onTimeRate = $totalCompletedCount > 0 ? (int) round(($onTimeCount / $totalCompletedCount) * 100) : 100;
        $weeklyTarget = 5;
        $weeklyProgressPercent = min(100, (int) round(($myCompletedThisWeek / $weeklyTarget) * 100));

        // 3. Cortex SLA Radar (Tasks with deadline <= 48 hours or blocked)
        $slaRadarTasks = Task::with(['workflow', 'stage', 'assignee'])
            ->where(function ($q) use ($user) {
                $q->where('assigned_to', $user->id)
                  ->orWhere('created_by', $user->id);
            })
            ->where(function ($q) {
                $q->where('status', 'blocked')
                  ->orWhere(function ($sq) {
                      $sq->where('status', '!=', 'completed')
                         ->whereNotNull('deadline')
                         ->where('deadline', '<=', now()->addHours(48));
                  });
            })
            ->orderByRaw("CASE WHEN status = 'blocked' THEN 1 ELSE 2 END")
            ->orderBy('deadline', 'asc')
            ->take(4)
            ->get();

        // 4. Team Workload Pulse (Distribution across colleagues)
        $teamWorkload = User::where('is_active', true)
            ->withCount([
                'assignedTasks as active_count' => fn($q) => $q->where('status', 'active'),
                'assignedTasks as blocked_count' => fn($q) => $q->where('status', 'blocked'),
            ])
            ->take(5)
            ->get();

        // 5. My Tasks Query
        $tasksQuery = Task::with(['workflow', 'stage'])
            ->where('assigned_to', $user->id);

        if ($this->taskFilter === 'active') {
            $tasksQuery->whereIn('status', ['active', 'pending']);
        } elseif ($this->taskFilter === 'blocked') {
            $tasksQuery->where('status', 'blocked');
        } elseif ($this->taskFilter === 'completed') {
            $tasksQuery->where('status', 'completed');
        } elseif ($this->taskFilter === 'overdue') {
            $tasksQuery->where('status', '!=', 'completed')
                ->whereNotNull('deadline')
                ->where('deadline', '<', now());
        }

        $myTasks = $tasksQuery
            ->orderByRaw("CASE priority WHEN 'critical' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 ELSE 4 END")
            ->orderBy('deadline', 'asc')
            ->get();

        // 6. Recent Activity
        $recentActivity = TaskActivity::with(['task', 'user'])
            ->whereHas('task', function ($q) use ($user) {
                $q->where('assigned_to', $user->id)
                  ->orWhere('created_by', $user->id);
            })
            ->latest('created_at')
            ->take(5)
            ->get();

        // Dropdown Data
        $availableWorkflows = Workflow::with('stages')->get();
        $selectedWorkflow = Workflow::find($this->newTaskWorkflowId);
        $availableStages = $selectedWorkflow ? $selectedWorkflow->stages : collect();
        $availableUsers = User::where('is_active', true)->get();

        return view('livewire.dashboard', [
            'myActiveTasks' => $myActiveTasks,
            'myNeedsAttention' => $myNeedsAttention,
            'myCompletedThisWeek' => $myCompletedThisWeek,
            'onTimeRate' => $onTimeRate,
            'weeklyTarget' => $weeklyTarget,
            'weeklyProgressPercent' => $weeklyProgressPercent,
            'slaRadarTasks' => $slaRadarTasks,
            'teamWorkload' => $teamWorkload,
            'myTasks' => $myTasks,
            'recentActivity' => $recentActivity,
            'availableWorkflows' => $availableWorkflows,
            'availableStages' => $availableStages,
            'availableUsers' => $availableUsers,
        ]);
    }
}
