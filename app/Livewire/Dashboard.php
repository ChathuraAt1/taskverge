<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskActivity;
use App\Models\Workflow;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Operational Intelligence Dashboard')]
class Dashboard extends Component
{
    public string $selectedDepartment = 'all';

    public ?int $selectedTaskId = null;

    public ?Task $selectedTask = null;

    public bool $showTaskModal = false;

    // Quick unblock / edit fields
    public string $unblockNote = '';

    /**
     * Triage: Quick unblock a task directly from the dashboard.
     */
    public function unblockTask(int $taskId): void
    {
        $task = Task::findOrFail($taskId);
        $oldStatus = $task->status;

        // Move to first active stage if exists or keep stage
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
            'Task unblocked by '.Auth::user()->name.' via Dashboard Triage',
            ['previous_status' => $oldStatus]
        );

        session()->flash('status', "Task {$task->task_number} has been unblocked and resumed.");
    }

    /**
     * Triage: Quick mark task completed from dashboard.
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
            'Task marked completed via Dashboard Quick Actions',
            ['status' => 'completed']
        );

        session()->flash('status', "Task {$task->task_number} marked completed.");
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
        $workflowQuery = Workflow::query()->with(['stages', 'tasks']);
        $taskQuery = Task::query()->with(['workflow', 'stage', 'assignee']);

        if ($this->selectedDepartment !== 'all') {
            $workflowQuery->where('department', $this->selectedDepartment);
            $taskQuery->whereHas('workflow', function ($q) {
                $q->where('department', $this->selectedDepartment);
            });
        }

        $workflows = $workflowQuery->get();

        // Metrics calculations
        $totalTasks = (clone $taskQuery)->count();
        $activeTasks = (clone $taskQuery)->where('status', 'active')->count();
        $completedTasks = (clone $taskQuery)->where('status', 'completed')->count();
        $blockedTasks = (clone $taskQuery)->where('status', 'blocked')->count();
        $overdueTasks = (clone $taskQuery)->overdue()->count();

        $completionRate = $totalTasks > 0 ? (int) round(($completedTasks / $totalTasks) * 100) : 0;

        // Priority breakdown
        $criticalTasks = (clone $taskQuery)->where('priority', 'critical')->where('status', '!=', 'completed')->count();
        $highTasks = (clone $taskQuery)->where('priority', 'high')->where('status', '!=', 'completed')->count();
        $mediumTasks = (clone $taskQuery)->where('priority', 'medium')->where('status', '!=', 'completed')->count();
        $lowTasks = (clone $taskQuery)->where('priority', 'low')->where('status', '!=', 'completed')->count();

        // Urgent triage queue: Overdue or Blocked tasks requiring attention
        $urgentAttentionTasks = (clone $taskQuery)
            ->where(function ($q) {
                $q->where('status', 'blocked')
                    ->orWhere(function ($sq) {
                        $sq->where('status', '!=', 'completed')
                            ->whereNotNull('deadline')
                            ->where('deadline', '<', now());
                    });
            })
            ->orderByRaw("CASE WHEN status = 'blocked' THEN 1 ELSE 2 END")
            ->orderByRaw("CASE priority WHEN 'critical' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 ELSE 4 END")
            ->take(6)
            ->get();

        // Recent audit trail activities
        $recentActivities = TaskActivity::query()
            ->with(['task.workflow', 'user'])
            ->latest('created_at')
            ->take(8)
            ->get();

        // Available departments
        $departments = Workflow::distinct()->pluck('department')->filter()->values();

        return view('livewire.dashboard', [
            'workflows' => $workflows,
            'totalTasks' => $totalTasks,
            'activeTasks' => $activeTasks,
            'completedTasks' => $completedTasks,
            'blockedTasks' => $blockedTasks,
            'overdueTasks' => $overdueTasks,
            'completionRate' => $completionRate,
            'criticalTasks' => $criticalTasks,
            'highTasks' => $highTasks,
            'mediumTasks' => $mediumTasks,
            'lowTasks' => $lowTasks,
            'urgentAttentionTasks' => $urgentAttentionTasks,
            'recentActivities' => $recentActivities,
            'departments' => $departments,
        ]);
    }
}
