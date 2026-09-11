<?php

namespace Tests\Feature;

use App\Livewire\WorkflowWorkspace;
use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $operator;

    protected Workflow $workflow;

    protected WorkflowStage $backlogStage;

    protected WorkflowStage $inProgressStage;

    protected WorkflowStage $blockedStage;

    protected WorkflowStage $completedStage;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'name' => 'Alexander Hayes',
            'email' => 'admin@taskverge.com',
            'role' => 'admin',
        ]);

        $this->operator = User::factory()->create([
            'name' => 'Marcus Vance',
            'email' => 'operator@taskverge.com',
            'role' => 'operator',
        ]);

        $this->workflow = Workflow::create([
            'title' => 'Cloud SRE Pipeline',
            'slug' => 'cloud-sre-pipeline',
            'department' => 'Cloud Infrastructure',
            'owner_id' => $this->admin->id,
            'status' => 'active',
        ]);

        $this->backlogStage = $this->workflow->stages()->create([
            'name' => 'Backlog',
            'slug' => 'backlog',
            'order' => 1,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $this->inProgressStage = $this->workflow->stages()->create([
            'name' => 'In Progress',
            'slug' => 'in-progress',
            'order' => 2,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $this->blockedStage = $this->workflow->stages()->create([
            'name' => 'Blocked',
            'slug' => 'blocked',
            'order' => 3,
            'is_terminal_success' => false,
            'is_blocked_stage' => true,
        ]);

        $this->completedStage = $this->workflow->stages()->create([
            'name' => 'Completed',
            'slug' => 'completed',
            'order' => 4,
            'is_terminal_success' => true,
            'is_blocked_stage' => false,
        ]);
    }

    public function test_user_can_create_task_via_livewire_workspace(): void
    {
        Livewire::actingAs($this->admin)
            ->test(WorkflowWorkspace::class, ['workflow' => $this->workflow])
            ->set('newTaskTitle', 'Deploy Triton GPU Cluster')
            ->set('newTaskStageId', $this->backlogStage->id)
            ->set('newTaskPriority', 'critical')
            ->set('newTaskAssigneeId', $this->operator->id)
            ->set('newTaskEstimatedHours', 24)
            ->call('createTask')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            'workflow_id' => $this->workflow->id,
            'title' => 'Deploy Triton GPU Cluster',
            'priority' => 'critical',
            'assigned_to' => $this->operator->id,
        ]);

        // Verify audit log creation
        $task = Task::where('title', 'Deploy Triton GPU Cluster')->first();
        $this->assertNotNull($task);
        $this->assertGreaterThan(0, $task->activities()->count());
    }

    public function test_moving_task_advances_stage_and_logs_activity(): void
    {
        $task = Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->backlogStage->id,
            'task_number' => 'TSK-9901',
            'title' => 'Sample Stage Movement Task',
            'priority' => 'high',
            'status' => 'pending',
        ]);

        Livewire::actingAs($this->admin)
            ->test(WorkflowWorkspace::class, ['workflow' => $this->workflow])
            ->call('moveTaskToStage', $task->id, $this->inProgressStage->id);

        $task->refresh();
        $this->assertEquals($this->inProgressStage->id, $task->stage_id);
        $this->assertEquals('active', $task->status);

        $this->assertDatabaseHas('task_activities', [
            'task_id' => $task->id,
            'action' => 'stage_moved',
        ]);
    }

    public function test_blocking_task_requires_reason_and_flags_status(): void
    {
        $task = Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->inProgressStage->id,
            'task_number' => 'TSK-9902',
            'title' => 'Sample Blocked Task',
            'priority' => 'high',
            'status' => 'active',
        ]);

        Livewire::actingAs($this->operator)
            ->test(WorkflowWorkspace::class, ['workflow' => $this->workflow])
            ->set('blockingTaskId', $task->id)
            ->set('blockReason', 'Hardware allocation delay from vendor')
            ->call('confirmBlockTask')
            ->assertHasNoErrors();

        $task->refresh();
        $this->assertEquals('blocked', $task->status);
        $this->assertEquals($this->blockedStage->id, $task->stage_id);
        $this->assertEquals('Hardware allocation delay from vendor', $task->blocked_reason);

        $this->assertDatabaseHas('task_activities', [
            'task_id' => $task->id,
            'action' => 'blocked',
        ]);
    }

    public function test_moving_to_terminal_stage_marks_task_completed(): void
    {
        $task = Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->inProgressStage->id,
            'task_number' => 'TSK-9903',
            'title' => 'Sample Completion Task',
            'priority' => 'medium',
            'status' => 'active',
        ]);

        Livewire::actingAs($this->admin)
            ->test(WorkflowWorkspace::class, ['workflow' => $this->workflow])
            ->call('moveTaskToStage', $task->id, $this->completedStage->id);

        $task->refresh();
        $this->assertEquals('completed', $task->status);
        $this->assertEquals($this->completedStage->id, $task->stage_id);
    }
}
