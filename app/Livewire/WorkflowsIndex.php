<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Workflow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Workflows & Projects Directory')]
class WorkflowsIndex extends Component
{
    public string $search = '';

    public string $selectedDepartment = 'all';

    public string $selectedStatus = 'active';

    public bool $showCreateModal = false;

    // Create workflow form fields
    public string $newTitle = '';

    public string $newDepartment = 'Enterprise Operations';

    public string $newDescription = '';

    public string $newColor = 'indigo';

    public ?int $newOwnerId = null;

    protected function rules(): array
    {
        return [
            'newTitle' => ['required', 'string', 'min:3', 'max:255'],
            'newDepartment' => ['required', 'string', 'max:100'],
            'newDescription' => ['nullable', 'string', 'max:1000'],
            'newColor' => ['required', 'string', 'in:indigo,emerald,blue,purple,amber,rose'],
            'newOwnerId' => ['nullable', 'exists:users,id'],
        ];
    }

    public function openCreateModal(): void
    {
        // Check authorization
        if (! Auth::user()->canManageWorkflows()) {
            session()->flash('status', 'Only Workflow Administrators and Operations Managers can create new pipelines.');

            return;
        }

        $this->reset(['newTitle', 'newDescription']);
        $this->newOwnerId = Auth::id();
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    public function createWorkflow(): void
    {
        if (! Auth::user()->canManageWorkflows()) {
            return;
        }

        $this->validate();

        $slug = Str::slug($this->newTitle);
        if (Workflow::where('slug', $slug)->exists()) {
            $slug .= '-'.Str::lower(Str::random(5));
        }

        $workflow = Workflow::create([
            'title' => $this->newTitle,
            'slug' => $slug,
            'department' => $this->newDepartment,
            'description' => $this->newDescription,
            'color' => $this->newColor,
            'owner_id' => $this->newOwnerId ?? Auth::id(),
            'status' => 'active',
            'is_starred' => false,
        ]);

        // Automatically create enterprise standard stages for this workflow
        $defaultStages = [
            ['name' => 'Backlog & Planning', 'slug' => 'backlog', 'order' => 1, 'color' => 'slate', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Active Processing', 'slug' => 'in-progress', 'order' => 2, 'color' => 'blue', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Review & QA Verification', 'slug' => 'review', 'order' => 3, 'color' => 'purple', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Blocked / Attention', 'slug' => 'blocked', 'order' => 4, 'color' => 'rose', 'is_terminal_success' => false, 'is_blocked_stage' => true],
            ['name' => 'Completed & Closed', 'slug' => 'completed', 'order' => 5, 'color' => 'emerald', 'is_terminal_success' => true, 'is_blocked_stage' => false],
        ];

        foreach ($defaultStages as $stg) {
            $workflow->stages()->create($stg);
        }

        $this->showCreateModal = false;
        session()->flash('status', "Workflow pipeline '{$workflow->title}' created with 5 standard stages.");

        $this->redirect(route('workflows.show', $workflow), navigate: true);
    }

    public function toggleStarred(int $workflowId): void
    {
        $workflow = Workflow::findOrFail($workflowId);
        $workflow->update(['is_starred' => ! $workflow->is_starred]);
    }

    public function render()
    {
        $query = Workflow::query()
            ->with(['owner', 'stages', 'tasks'])
            ->withCount(['tasks']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->selectedDepartment !== 'all') {
            $query->where('department', $this->selectedDepartment);
        }

        if ($this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        $workflows = $query->latest()->get();
        $departments = Workflow::distinct()->pluck('department')->filter()->values();
        $managers = User::whereIn('role', ['admin', 'manager'])->get();

        return view('livewire.workflows-index', [
            'workflows' => $workflows,
            'departments' => $departments,
            'managers' => $managers,
        ]);
    }
}
