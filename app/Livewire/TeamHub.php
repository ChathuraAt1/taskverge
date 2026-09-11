<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Team Capacity Hub')]
class TeamHub extends Component
{
    public string $departmentFilter = 'all';
    public string $search = '';

    // Quick Assign Modal state
    public bool $showAssignModal = false;
    public ?int $selectedUserId = null;
    public ?int $selectedTaskId = null;

    public function openAssignModal(int $userId): void
    {
        $this->selectedUserId = $userId;
        $this->showAssignModal = true;
    }

    public function closeAssignModal(): void
    {
        $this->showAssignModal = false;
        $this->selectedUserId = null;
        $this->selectedTaskId = null;
    }

    public function assignTask(): void
    {
        $this->validate([
            'selectedUserId' => ['required', 'exists:users,id'],
            'selectedTaskId' => ['required', 'exists:tasks,id'],
        ]);

        $task = Task::findOrFail($this->selectedTaskId);
        $user = User::findOrFail($this->selectedUserId);

        $task->update(['assigned_to' => $user->id]);

        $task->recordActivity(
            'assigned',
            "Reassigned to {$user->name} via Team Capacity Hub",
            ['assigned_to' => $user->name]
        );

        session()->flash('status', "Task {$task->task_number} successfully assigned to {$user->name}.");
        $this->closeAssignModal();
    }

    public function render()
    {
        $currentUser = Auth::user();
        $planConfig = $currentUser->getPlanConfig();
        $maxUsers = $planConfig['max_users'] ?? null;

        $query = User::where('is_active', true)
            ->withCount([
                'assignedTasks as active_tasks_count' => fn($q) => $q->whereIn('status', ['active', 'pending']),
                'assignedTasks as blocked_tasks_count' => fn($q) => $q->where('status', 'blocked'),
                'assignedTasks as completed_tasks_count' => fn($q) => $q->where('status', 'completed'),
            ]);

        if ($this->departmentFilter !== 'all') {
            $query->where('department', $this->departmentFilter);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('title', 'like', '%' . $this->search . '%');
            });
        }

        $members = $query->orderBy('name')->get()->map(function ($member) {
            $activeCount = $member->active_tasks_count;
            if ($activeCount === 0) {
                $member->capacity_status = 'available';
                $member->capacity_label = 'Available';
                $member->capacity_color = 'slate';
            } elseif ($activeCount <= 3) {
                $member->capacity_status = 'optimal';
                $member->capacity_label = 'Optimal Load';
                $member->capacity_color = 'emerald';
            } elseif ($activeCount <= 6) {
                $member->capacity_status = 'high';
                $member->capacity_label = 'High Load';
                $member->capacity_color = 'amber';
            } else {
                $member->capacity_status = 'overloaded';
                $member->capacity_label = 'Overloaded';
                $member->capacity_color = 'rose';
            }

            return $member;
        });

        $totalMembersCount = User::where('is_active', true)->count();

        // Tasks available for assignment
        $assignableTasks = Task::with('workflow')
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $departments = User::whereNotNull('department')->pluck('department')->unique()->values();

        return view('livewire.team-hub', [
            'members' => $members,
            'departments' => $departments,
            'totalMembersCount' => $totalMembersCount,
            'maxUsers' => $maxUsers,
            'planConfig' => $planConfig,
            'assignableTasks' => $assignableTasks,
        ]);
    }
}
