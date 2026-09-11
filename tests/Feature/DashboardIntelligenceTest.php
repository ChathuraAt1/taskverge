<?php

namespace Tests\Feature;

use App\Livewire\Dashboard;
use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use App\Services\CortexAiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardIntelligenceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected User $teammate;
    protected Workflow $workflow;
    protected WorkflowStage $stage1;
    protected WorkflowStage $stage2;
    protected WorkflowStage $blockedStage;
    protected WorkflowStage $completedStage;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'Elena Rostova',
            'email' => 'elena@taskverge.com',
            'role' => 'manager',
            'department' => 'Autonomous Systems',
        ]);

        $this->teammate = User::factory()->create([
            'name' => 'David Kim',
            'email' => 'david@taskverge.com',
            'role' => 'operator',
            'department' => 'Autonomous Systems',
        ]);

        $this->workflow = Workflow::create([
            'title' => 'Core Inference Operations',
            'slug' => 'core-inference-operations',
            'department' => 'Autonomous Systems',
            'owner_id' => $this->user->id,
            'status' => 'active',
        ]);

        $this->stage1 = $this->workflow->stages()->create([
            'name' => 'Triage',
            'slug' => 'triage',
            'order' => 1,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $this->stage2 = $this->workflow->stages()->create([
            'name' => 'Execution',
            'slug' => 'execution',
            'order' => 2,
            'is_terminal_success' => false,
            'is_blocked_stage' => false,
        ]);

        $this->blockedStage = $this->workflow->stages()->create([
            'name' => 'Impediment Block',
            'slug' => 'impediment-block',
            'order' => 3,
            'is_terminal_success' => false,
            'is_blocked_stage' => true,
        ]);

        $this->completedStage = $this->workflow->stages()->create([
            'name' => 'Production Release',
            'slug' => 'production-release',
            'order' => 4,
            'is_terminal_success' => true,
            'is_blocked_stage' => false,
        ]);
    }

    public function test_dashboard_renders_successfully_with_velocity_metrics(): void
    {
        Task::create([
            'task_number' => 'TSK-1001',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage1->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Calibrate Triton NIM endpoints',
            'priority' => 'high',
            'status' => 'active',
            'deadline' => now()->addDays(3),
        ]);

        Task::create([
            'task_number' => 'TSK-1002',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->completedStage->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Optimize CUDA streaming buffer',
            'priority' => 'medium',
            'status' => 'completed',
            'updated_at' => now(),
        ]);

        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->assertStatus(200)
            ->assertSee('Active Tasks')
            ->assertSee('Calibrate Triton NIM endpoints')
            ->set('taskFilter', 'completed')
            ->assertSee('Optimize CUDA streaming buffer');
    }

    public function test_quick_task_creator_creates_task_with_generated_number(): void
    {
        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->set('newTaskTitle', 'Deploy Quantized Nemotron-4-340B')
            ->set('newTaskWorkflowId', $this->workflow->id)
            ->set('newTaskStageId', $this->stage1->id)
            ->set('newTaskPriority', 'critical')
            ->set('newTaskAssigneeId', $this->user->id)
            ->set('newTaskEstimatedHours', 8.5)
            ->set('newTaskDescription', 'Configure FP8 weights on H100 cluster.')
            ->set('newTaskTagsInput', 'ai, inference, nvidia')
            ->call('saveQuickTask')
            ->assertHasNoErrors()
            ->assertSet('showCreateTaskModal', false)
            ->assertSee('Deploy Quantized Nemotron-4-340B');

        $createdTask = Task::where('title', 'Deploy Quantized Nemotron-4-340B')->first();
        $this->assertNotNull($createdTask);
        $this->assertStringStartsWith('TSK-', $createdTask->task_number);
        $this->assertEquals('critical', $createdTask->priority);
        $this->assertEquals(8.5, (float) $createdTask->estimated_hours);
        $this->assertContains('nvidia', $createdTask->tags);
    }

    public function test_ai_suggest_triage_uses_service_and_updates_form(): void
    {
        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->set('newTaskTitle', 'Critical production outage: database connection pool exhausted')
            ->set('newTaskDescription', 'Security breach and service failure detected')
            ->call('aiSuggestTriage')
            ->assertSet('newTaskPriority', 'critical')
            ->assertHasNoErrors();
    }

    public function test_sla_radar_detects_at_risk_and_blocked_tasks(): void
    {
        $urgentTask = Task::create([
            'task_number' => 'TSK-2001',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage1->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Urgent security patch for API gateway',
            'priority' => 'critical',
            'status' => 'active',
            'deadline' => now()->addHours(12),
        ]);

        $blockedTask = Task::create([
            'task_number' => 'TSK-2002',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->blockedStage->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'GPU driver incompatibility',
            'priority' => 'high',
            'status' => 'blocked',
            'blocked_reason' => 'CUDA driver 550 incompatible with kernel 6.8',
        ]);

        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->assertSee('Cortex SLA Radar')
            ->assertSee('Urgent security patch for API gateway')
            ->assertSee('GPU driver incompatibility')
            ->assertSee('CUDA driver 550 incompatible with kernel 6.8');
    }

    public function test_unblock_task_from_dashboard(): void
    {
        $blockedTask = Task::create([
            'task_number' => 'TSK-2003',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->blockedStage->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Blocked pipeline verification',
            'priority' => 'medium',
            'status' => 'blocked',
            'blocked_reason' => 'Waiting on API keys',
        ]);

        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->call('unblockTask', $blockedTask->id)
            ->assertStatus(200);

        $blockedTask->refresh();
        $this->assertEquals('active', $blockedTask->status);
        $this->assertNull($blockedTask->blocked_reason);
    }

    public function test_standup_report_modal_generates_markdown(): void
    {
        Task::create([
            'task_number' => 'TSK-3001',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage1->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Telemetry ingestion pipeline',
            'priority' => 'high',
            'status' => 'active',
        ]);

        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->call('openStandupModal')
            ->assertSet('showStandupModal', true)
            ->assertSee('Daily Standup')
            ->assertSee('Executive status report synthesized by Cortex AI');
    }

    public function test_tasks_csv_export_returns_streamed_download(): void
    {
        Task::create([
            'task_number' => 'TSK-4001',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->stage1->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Exportable audit test task',
            'priority' => 'low',
            'status' => 'active',
        ]);

        $this->actingAs($this->user);

        Livewire::test(Dashboard::class)
            ->call('exportTasksCsv')
            ->assertFileDownloaded('taskverge-tasks-' . date('Y-m-d') . '.csv');
    }

    public function test_cortex_ai_service_fallback_heuristics(): void
    {
        $aiService = app(CortexAiService::class);

        $triage = $aiService->suggestTriage('Security incident urgent database lock', 'Immediate mitigation required');
        $this->assertIsArray($triage);
        $this->assertContains($triage['priority'], ['critical', 'high']);
        $this->assertNotEmpty($triage['reasoning']);

        $task = Task::create([
            'task_number' => 'TSK-5001',
            'workflow_id' => $this->workflow->id,
            'stage_id' => $this->blockedStage->id,
            'created_by' => $this->user->id,
            'assigned_to' => $this->user->id,
            'title' => 'Missing AWS IAM permissions',
            'priority' => 'high',
            'status' => 'blocked',
            'blocked_reason' => 'Missing permission to assume IAM role for cluster',
        ]);

        $blockerAnalysis = $aiService->analyzeBlocker($task);
        $this->assertIsArray($blockerAnalysis);
        $this->assertArrayHasKey('recommendation', $blockerAnalysis);
    }
}
