<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskActivity;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public ?int $selectedTaskId = null;
    public ?Task $selectedTask = null;
    public bool $showTaskModal = false;
    public string $taskFilter = 'active';

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

        // My task counts
        $myActiveTasks = Task::where('assigned_to', $user->id)->where('status', 'active')->count();
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

        // My tasks list
        $tasksQuery = Task::with(['workflow', 'stage'])
            ->where('assigned_to', $user->id);

        if ($this->taskFilter === 'active') {
            $tasksQuery->where('status', 'active');
        } elseif ($this->taskFilter === 'blocked') {
            $tasksQuery->where('status', 'blocked');
        } elseif ($this->taskFilter === 'completed') {
            $tasksQuery->where('status', 'completed');
        } elseif ($this->taskFilter === 'overdue') {
            $tasksQuery->where('status', '!=', 'completed')
                ->whereNotNull('deadline')
                ->where('deadline', '<', now());
        }
        // 'all' shows everything

        $myTasks = $tasksQuery
            ->orderByRaw("CASE priority WHEN 'critical' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 ELSE 4 END")
            ->orderBy('deadline', 'asc')
            ->get();

        // Recent activity on my tasks
        $recentActivity = TaskActivity::with(['task', 'user'])
            ->whereHas('task', function ($q) use ($user) {
                $q->where('assigned_to', $user->id)
                  ->orWhere('created_by', $user->id);
            })
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'myActiveTasks' => $myActiveTasks,
            'myNeedsAttention' => $myNeedsAttention,
            'myCompletedThisWeek' => $myCompletedThisWeek,
            'myTasks' => $myTasks,
            'recentActivity' => $recentActivity,
        ]);
    }
}
