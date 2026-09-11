<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Master Task Registry')]
class TasksIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public string $workflowFilter = 'all';

    public string $priorityFilter = 'all';

    public string $statusFilter = 'all';

    public string $assigneeFilter = 'all';

    public bool $showTaskModal = false;

    public ?Task $selectedTask = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function inspectTask(int $taskId): void
    {
        $this->selectedTask = Task::with(['workflow', 'stage', 'assignee', 'creator', 'activities.user'])->findOrFail($taskId);
        $this->showTaskModal = true;
    }

    public function closeTaskModal(): void
    {
        $this->showTaskModal = false;
        $this->selectedTask = null;
    }

    public function render()
    {
        $query = Task::query()
            ->with(['workflow', 'stage', 'assignee']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('task_number', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->workflowFilter !== 'all') {
            $query->where('workflow_id', $this->workflowFilter);
        }

        if ($this->priorityFilter !== 'all') {
            $query->where('priority', $this->priorityFilter);
        }

        if ($this->assigneeFilter !== 'all') {
            if ($this->assigneeFilter === 'unassigned') {
                $query->whereNull('assigned_to');
            } else {
                $query->where('assigned_to', $this->assigneeFilter);
            }
        }

        if ($this->statusFilter !== 'all') {
            if ($this->statusFilter === 'overdue') {
                $query->overdue();
            } else {
                $query->where('status', $this->statusFilter);
            }
        }

        $tasks = $query->latest()->paginate(15);
        $workflows = Workflow::query()->select('id', 'title')->get();
        $assignees = User::query()->where('is_active', true)->get();

        return view('livewire.tasks-index', [
            'tasks' => $tasks,
            'workflows' => $workflows,
            'assignees' => $assignees,
        ]);
    }
}
