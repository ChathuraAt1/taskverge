<?php

namespace Tests\Feature;

use App\Livewire\Dashboard;
use App\Livewire\WorkflowsIndex;
use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WorkflowIntelligenceTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $operator;

    protected Workflow $workflow;

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
            'title' => 'Logistics Automation',
            'slug' => 'logistics-automation',
            'department' => 'Global Logistics & Supply Chain',
            'owner_id' => $this->admin->id,
            'status' => 'active',
        ]);

        $stage1 = $this->workflow->stages()->create([
            'name' => 'Intake',
            'slug' => 'intake',
            'order' => 1,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $stage2 = $this->workflow->stages()->create([
            'name' => 'Processing',
            'slug' => 'processing',
            'order' => 2,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $stageCompleted = $this->workflow->stages()->create([
            'name' => 'Delivered',
            'slug' => 'delivered',
            'order' => 3,
            'is_terminal_success' => true,
            'is_blocked_stage' => false,
        ]);

        // Overdue task
        Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $stage1->id,
            'task_number' => 'TSK-5001',
            'title' => 'Overdue Customs Clearing',
            'priority' => 'critical',
            'status' => 'active',
            'deadline' => now()->subDays(2),
        ]);

        // Blocked task
        Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $stage2->id,
            'task_number' => 'TSK-5002',
            'title' => 'Blocked Port Inspection',
            'priority' => 'high',
            'status' => 'blocked',
            'blocked_reason' => 'Quarantine hold',
        ]);

        // Completed task
        Task::create([
            'workflow_id' => $this->workflow->id,
            'stage_id' => $stageCompleted->id,
            'task_number' => 'TSK-5003',
            'title' => 'Delivered Container Batch',
            'priority' => 'medium',
            'status' => 'completed',
        ]);
    }

    public function test_dashboard_renders_with_accurate_telemetry_metrics(): void
    {
        Livewire::actingAs($this->admin)
            ->test(Dashboard::class)
            ->assertViewHas('totalTasks', 3)
            ->assertViewHas('activeTasks', 1)
            ->assertViewHas('completedTasks', 1)
            ->assertViewHas('blockedTasks', 1)
            ->assertViewHas('overdueTasks', 1)
            ->assertSee('Logistics Automation')
            ->assertSee('Blocked Port Inspection');
    }

    public function test_dashboard_triage_unblock_restores_active_status(): void
    {
        $blockedTask = Task::where('status', 'blocked')->first();

        Livewire::actingAs($this->admin)
            ->test(Dashboard::class)
            ->call('unblockTask', $blockedTask->id);

        $blockedTask->refresh();
        $this->assertEquals('active', $blockedTask->status);
        $this->assertNull($blockedTask->blocked_reason);
    }

    public function test_admin_can_provision_workflow_pipeline(): void
    {
        Livewire::actingAs($this->admin)
            ->test(WorkflowsIndex::class)
            ->set('newTitle', 'SOC2 Continuous Auditing')
            ->set('newDepartment', 'Regulatory Compliance')
            ->set('newDescription', 'Continuous access log checks and evidence generation')
            ->set('newColor', 'amber')
            ->call('createWorkflow')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('workflows', [
            'title' => 'SOC2 Continuous Auditing',
            'department' => 'Regulatory Compliance',
        ]);

        $createdWf = Workflow::where('title', 'SOC2 Continuous Auditing')->first();
        $this->assertEquals(5, $createdWf->stages()->count());
    }

    public function test_operator_cannot_provision_workflow(): void
    {
        Livewire::actingAs($this->operator)
            ->test(WorkflowsIndex::class)
            ->set('newTitle', 'Unauthorized Pipeline')
            ->set('newDepartment', 'Operations')
            ->call('createWorkflow');

        $this->assertDatabaseMissing('workflows', [
            'title' => 'Unauthorized Pipeline',
        ]);
    }
}
