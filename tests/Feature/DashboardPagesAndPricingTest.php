<?php

namespace Tests\Feature;

use App\Livewire\AnalyticsDashboard;
use App\Livewire\AuditLog;
use App\Livewire\CopilotWorkspace;
use App\Livewire\TeamHub;
use App\Models\Task;
use App\Models\TaskActivity;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardPagesAndPricingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected User $teammate;
    protected Workflow $workflow;
    protected WorkflowStage $stage1;
    protected WorkflowStage $stage2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'Sophia Lin',
            'email' => 'sophia@taskverge.com',
            'role' => 'manager',
            'department' => 'Cloud Infrastructure',
            'subscription_plan' => 'core',
        ]);

        $this->teammate = User::factory()->create([
            'name' => 'Liam Scott',
            'email' => 'liam@taskverge.com',
            'role' => 'operator',
            'department' => 'Cloud Infrastructure',
            'subscription_plan' => 'core',
        ]);

        $this->workflow = Workflow::create([
            'title' => 'Kubernetes Ingress Orchestration',
            'slug' => 'k8s-ingress-orchestration',
            'department' => 'Cloud Infrastructure',
            'owner_id' => $this->user->id,
            'status' => 'active',
        ]);

        $this->stage1 = $this->workflow->stages()->create([
            'name' => 'Intake',
            'slug' => 'intake',
            'order' => 1,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $this->stage2 = $this->workflow->stages()->create([
            'name' => 'Deployed',
            'slug' => 'deployed',
            'order' => 2,
            'is_terminal_success' => true,
            'is_blocked_stage' => false,
        ]);
    }

    public function test_authenticated_user_can_access_all_dashboard_pages(): void
    {
        $this->actingAs($this->user);

        $this->get('/app/copilot')
            ->assertStatus(200)
            ->assertSee('TaskVerge Cortex Copilot');

        $this->get('/app/analytics')
            ->assertStatus(200)
            ->assertSee('Analytics &amp; SLA Telemetry', false);

        $this->get('/app/team')
            ->assertStatus(200)
            ->assertSee('Team Capacity &amp; Workload Hub', false);

        $this->get('/app/audit')
            ->assertStatus(200)
            ->assertSee('Compliance &amp; Activity Audit Trail', false);
    }

    public function test_copilot_chat_message_and_heuristic_response(): void
    {
        $this->actingAs($this->user);

        Livewire::test(CopilotWorkspace::class)
            ->set('inputPrompt', 'What tasks are currently blocked across our pipelines?')
            ->call('sendMessage')
            ->assertHasNoErrors()
            ->assertSee('Zero Blockers Detected');
    }

    public function test_copilot_deploys_task_draft(): void
    {
        $this->actingAs($this->user);

        $component = Livewire::test(CopilotWorkspace::class)
            ->call('sendPreset', 'Draft a task to optimize GPU inference batching in Triton')
            ->assertHasNoErrors();

        $component->call('deployDraftTask')
            ->assertHasNoErrors()
            ->assertSee('Success!');

        $this->assertDatabaseHas('tasks', [
            'workflow_id' => $this->workflow->id,
            'title' => 'Optimize GPU inference batching in Triton',
        ]);
    }

    public function test_analytics_dashboard_metrics_and_retention_gate(): void
    {
        Task::create([
            'task_number' => 'TSK-9901',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage2->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Calibrated network interface',
            'priority' => 'medium',
            'status' => 'completed',
            'deadline' => now()->addDay(),
            'updated_at' => now(),
        ]);

        $this->actingAs($this->user);

        Livewire::test(AnalyticsDashboard::class)
            ->assertStatus(200)
            ->assertSee('On-Time Delivery SLA')
            ->assertSee('100%');

        // Test Free tier retention restriction
        $freeUser = User::factory()->create([
            'name' => 'Trial User',
            'email' => 'trial@taskverge.com',
            'subscription_plan' => 'free',
        ]);

        $this->actingAs($freeUser);

        Livewire::test(AnalyticsDashboard::class)
            ->call('setRange', '90d')
            ->assertSet('timeRange', '7d')
            ->assertSee('includes 7 days of telemetry retention');
    }

    public function test_team_hub_capacity_status_and_task_assignment(): void
    {
        $task = Task::create([
            'task_number' => 'TSK-9902',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage1->id,
            'created_by' => $this->user->id,
            'assigned_to' => null,
            'title' => 'Unassigned ingress controller update',
            'priority' => 'high',
            'status' => 'active',
        ]);

        $this->actingAs($this->user);

        Livewire::test(TeamHub::class)
            ->assertStatus(200)
            ->assertSee('Sophia Lin')
            ->assertSee('Liam Scott')
            ->call('openAssignModal', $this->teammate->id)
            ->set('selectedTaskId', $task->id)
            ->call('assignTask')
            ->assertHasNoErrors();

        $task->refresh();
        $this->assertEquals($this->teammate->id, $task->assigned_to);
    }

    public function test_audit_log_filters_and_csv_export(): void
    {
        $task = Task::create([
            'task_number' => 'TSK-9903',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage1->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Audit log trace item',
            'priority' => 'low',
            'status' => 'active',
        ]);

        $task->recordActivity('created', 'Initial task logged', null, $this->user);

        $this->actingAs($this->user);

        Livewire::test(AuditLog::class)
            ->assertStatus(200)
            ->assertSee('TSK-9903')
            ->assertSee('Audit log trace item')
            ->call('exportCsv')
            ->assertFileDownloaded('taskverge-audit-log-' . date('Y-m-d') . '.csv');
    }

    public function test_user_plan_limit_helpers(): void
    {
        $freeUser = new User(['subscription_plan' => 'free']);
        $this->assertEquals(20, $freeUser->getCopilotLimit());
        $this->assertEquals(7, $freeUser->getAnalyticsHistoryDays());
        $this->assertEquals(7, $freeUser->getAuditRetentionDays());

        $coreUser = new User(['subscription_plan' => 'core']);
        $this->assertEquals(500, $coreUser->getCopilotLimit());
        $this->assertEquals(90, $coreUser->getAnalyticsHistoryDays());
        $this->assertEquals(90, $coreUser->getAuditRetentionDays());

        $enterpriseUser = new User(['subscription_plan' => 'intelligence']);
        $this->assertNull($enterpriseUser->getCopilotLimit());
        $this->assertNull($enterpriseUser->getAnalyticsHistoryDays());
        $this->assertNull($enterpriseUser->getAuditRetentionDays());
    }

    public function test_landing_page_displays_updated_plan_limits(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('20 AI Copilot queries / mo');
        $response->assertSee('500 AI Copilot queries / mo');
        $response->assertSee('Unlimited AI Copilot queries');
        $response->assertSee('7-day analytics');
        $response->assertSee('90-day analytics');
    }
}
