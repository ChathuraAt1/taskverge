<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with enterprise data.
     */
    public function run(): void
    {
        // Create or sync Super Admin from environment
        if (env('SUPER_ADMIN_EMAIL')) {
            \App\Models\User::updateOrCreate(
                ['email' => env('SUPER_ADMIN_EMAIL')],
                [
                    'name' => env('SUPER_ADMIN_NAME', 'Super Admin'),
                    'password' => Hash::make(env('SUPER_ADMIN_PASSWORD', 'password')),
                    'role' => 'super_admin',
                    'department' => 'Platform Administration',
                    'title' => 'Platform Super Administrator',
                    'is_active' => true,
                    'subscription_plan' => 'intelligence',
                    'subscription_status' => 'active',
                ]
            );
        }

        // 1. Seed Enterprise Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@taskverge.com'],
            [
                'name' => 'Alexander Hayes',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'department' => 'Enterprise Operations',
                'title' => 'Chief Operations Architect',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
                'is_active' => true,
            ]
        );

        $manager = User::firstOrCreate(
            ['email' => 'manager@taskverge.com'],
            [
                'name' => 'Dr. Elena Rostova',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'department' => 'Global Logistics & Supply Chain',
                'title' => 'Director of Workflow Automation',
                'avatar_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&auto=format&fit=crop&q=80',
                'is_active' => true,
            ]
        );

        $operator1 = User::firstOrCreate(
            ['email' => 'operator@taskverge.com'],
            [
                'name' => 'Marcus Vance',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'department' => 'Regulatory Compliance',
                'title' => 'Lead Systems Operator',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
                'is_active' => true,
            ]
        );

        $manager2 = User::firstOrCreate(
            ['email' => 'sarah.chen@taskverge.com'],
            [
                'name' => 'Sarah Chen',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'department' => 'Cloud Infrastructure',
                'title' => 'VP of Cloud Engineering',
                'avatar_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
                'is_active' => true,
            ]
        );

        $operator2 = User::firstOrCreate(
            ['email' => 'devon.reed@taskverge.com'],
            [
                'name' => 'Devon Reed',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'department' => 'Cloud Infrastructure',
                'title' => 'Site Reliability Engineer',
                'avatar_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
                'is_active' => true,
            ]
        );

        // 2. Seed Workflow 1: Cloud Infrastructure Migration
        $wf1 = Workflow::create([
            'title' => 'Enterprise Cloud Migration & Triton Acceleration',
            'slug' => 'enterprise-cloud-migration-triton',
            'description' => 'Coordination of hybrid multi-region cloud workloads, NVIDIA Triton inference server scaling, and database failover routines.',
            'department' => 'Cloud Infrastructure',
            'status' => 'active',
            'owner_id' => $manager2->id,
            'color' => 'indigo',
            'is_starred' => true,
        ]);

        $wf1_stages = [
            ['name' => 'Architecture Backlog', 'slug' => 'backlog', 'order' => 1, 'color' => 'slate', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'In Progress', 'slug' => 'in-progress', 'order' => 2, 'color' => 'blue', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Security & Compliance Review', 'slug' => 'review', 'order' => 3, 'color' => 'purple', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Blocked / Attention Required', 'slug' => 'blocked', 'order' => 4, 'color' => 'rose', 'is_terminal_success' => false, 'is_blocked_stage' => true],
            ['name' => 'Deployed & Completed', 'slug' => 'completed', 'order' => 5, 'color' => 'emerald', 'is_terminal_success' => true, 'is_blocked_stage' => false],
        ];

        $wf1StageModels = [];
        foreach ($wf1_stages as $stageData) {
            $wf1StageModels[$stageData['slug']] = $wf1->stages()->create($stageData);
        }

        // Tasks for Workflow 1
        $task1 = Task::create([
            'workflow_id' => $wf1->id,
            'stage_id' => $wf1StageModels['blocked']->id,
            'task_number' => 'TSK-1001',
            'title' => 'Provision Multi-Node Triton Inference Cluster with H100 Accelerators',
            'description' => 'Deploy high-throughput NVIDIA Triton serving microservices behind internal API gateways with automatic failover.',
            'priority' => 'critical',
            'status' => 'blocked',
            'deadline' => now()->subDays(2), // OVERDUE & BLOCKED
            'assigned_to' => $operator2->id,
            'created_by' => $manager2->id,
            'blocked_reason' => 'Vendor quota limit reached for H100 SXM5 instances in us-east-2. Escalated to cloud account executive.',
            'estimated_hours' => 36,
            'actual_hours' => 14,
            'tags' => ['Triton', 'Infrastructure', 'GPU', 'Critical'],
            'order_column' => 1,
        ]);

        $task1->recordActivity('created', 'Task created by Sarah Chen', null, $manager2);
        $task1->recordActivity('assigned', 'Assigned to Devon Reed', ['assignee' => 'Devon Reed'], $manager2);
        $task1->recordActivity('stage_moved', 'Moved from Backlog to In Progress', ['stage' => 'In Progress'], $operator2);
        $task1->recordActivity('blocked', 'Flagged as Blocked: Vendor quota limit reached for H100 SXM5 instances', ['reason' => $task1->blocked_reason], $operator2);

        $task2 = Task::create([
            'workflow_id' => $wf1->id,
            'stage_id' => $wf1StageModels['in-progress']->id,
            'task_number' => 'TSK-1002',
            'title' => 'Configure Nemotron Model Gateway Routing & Latency Budgets',
            'description' => 'Establish upstream request hedging and semantic caching layer for Nemotron-70B conversational agents.',
            'priority' => 'high',
            'status' => 'active',
            'deadline' => now()->addDays(3),
            'assigned_to' => $operator2->id,
            'created_by' => $admin->id,
            'estimated_hours' => 20,
            'actual_hours' => 8,
            'tags' => ['Nemotron', 'AI-Gateway', 'Performance'],
            'order_column' => 2,
        ]);
        $task2->recordActivity('created', 'Task initiated by Alexander Hayes', null, $admin);
        $task2->recordActivity('assigned', 'Assigned to Devon Reed', null, $admin);

        $task3 = Task::create([
            'workflow_id' => $wf1->id,
            'stage_id' => $wf1StageModels['review']->id,
            'task_number' => 'TSK-1003',
            'title' => 'Zero-Trust IAM Policy Validation for Model Inference Endpoints',
            'description' => 'Audit granular service accounts and mTLS communication across enterprise network boundaries.',
            'priority' => 'high',
            'status' => 'active',
            'deadline' => now()->subDay(), // OVERDUE
            'assigned_to' => $operator1->id,
            'created_by' => $admin->id,
            'estimated_hours' => 16,
            'actual_hours' => 12,
            'tags' => ['Security', 'Zero-Trust', 'Audit'],
            'order_column' => 3,
        ]);
        $task3->recordActivity('created', 'Created task', null, $admin);
        $task3->recordActivity('stage_moved', 'Moved to Security & Compliance Review', null, $operator1);

        $task4 = Task::create([
            'workflow_id' => $wf1->id,
            'stage_id' => $wf1StageModels['completed']->id,
            'task_number' => 'TSK-1004',
            'title' => 'Baseline Architecture Benchmarking & Observability Setup',
            'description' => 'Setup Grafana, Prometheus metrics, and distributed tracing across Kubernetes clusters.',
            'priority' => 'medium',
            'status' => 'completed',
            'deadline' => now()->subDays(5),
            'assigned_to' => $operator2->id,
            'created_by' => $manager2->id,
            'estimated_hours' => 24,
            'actual_hours' => 22,
            'tags' => ['Observability', 'Grafana'],
            'order_column' => 4,
        ]);
        $task4->recordActivity('created', 'Task initialized', null, $manager2);
        $task4->recordActivity('status_changed', 'Task marked as completed', ['status' => 'completed'], $operator2);

        $task5 = Task::create([
            'workflow_id' => $wf1->id,
            'stage_id' => $wf1StageModels['backlog']->id,
            'task_number' => 'TSK-1005',
            'title' => 'Disaster Recovery Warm Standby Drill Simulation',
            'description' => 'Simulate complete regional outage and measure automated failover convergence time.',
            'priority' => 'medium',
            'status' => 'pending',
            'deadline' => now()->addDays(12),
            'assigned_to' => null,
            'created_by' => $manager2->id,
            'estimated_hours' => 18,
            'actual_hours' => 0,
            'tags' => ['Disaster-Recovery', 'Reliability'],
            'order_column' => 5,
        ]);
        $task5->recordActivity('created', 'Added to architecture backlog', null, $manager2);

        // 3. Seed Workflow 2: Global Supply Chain & Logistics Pipeline
        $wf2 = Workflow::create([
            'title' => 'Global Logistics Orchestration & Route Optimization',
            'slug' => 'global-logistics-orchestration',
            'description' => 'Automated scheduling, freight forwarding visibility, customs clearing bottlenecks, and port delay tracking.',
            'department' => 'Global Logistics & Supply Chain',
            'status' => 'active',
            'owner_id' => $manager->id,
            'color' => 'emerald',
            'is_starred' => true,
        ]);

        $wf2_stages = [
            ['name' => 'Intake & Manifest', 'slug' => 'intake', 'order' => 1, 'color' => 'slate', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Active Processing', 'slug' => 'processing', 'order' => 2, 'color' => 'blue', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Customs & Port Hold', 'slug' => 'customs-hold', 'order' => 3, 'color' => 'rose', 'is_terminal_success' => false, 'is_blocked_stage' => true],
            ['name' => 'Final Clearance & Dispatch', 'slug' => 'cleared', 'order' => 4, 'color' => 'emerald', 'is_terminal_success' => true, 'is_blocked_stage' => false],
        ];

        $wf2StageModels = [];
        foreach ($wf2_stages as $stageData) {
            $wf2StageModels[$stageData['slug']] = $wf2->stages()->create($stageData);
        }

        $task6 = Task::create([
            'workflow_id' => $wf2->id,
            'stage_id' => $wf2StageModels['customs-hold']->id,
            'task_number' => 'TSK-2001',
            'title' => 'Rotterdam Terminal Port Clearance & Quarantine Inspection',
            'description' => 'Expedite phytosanitary documentation and tariff codes for 40 TEU cold-storage containers.',
            'priority' => 'critical',
            'status' => 'blocked',
            'deadline' => now()->subDay(), // OVERDUE & BLOCKED
            'assigned_to' => $operator1->id,
            'created_by' => $manager->id,
            'blocked_reason' => 'Awaiting missing country-of-origin cert from regional export authority.',
            'estimated_hours' => 12,
            'actual_hours' => 6,
            'tags' => ['Customs', 'Expedite', 'Europe'],
            'order_column' => 1,
        ]);
        $task6->recordActivity('created', 'Initiated container shipment review', null, $manager);
        $task6->recordActivity('blocked', 'Stage moved to Customs & Port Hold: Awaiting missing cert', ['reason' => $task6->blocked_reason], $operator1);

        $task7 = Task::create([
            'workflow_id' => $wf2->id,
            'stage_id' => $wf2StageModels['processing']->id,
            'task_number' => 'TSK-2002',
            'title' => 'Predictive Fuel Optimization Route Calculation for Pacific Vessels',
            'description' => 'Execute meteorological routing model to minimize fuel burn while bypassing North Pacific winter storms.',
            'priority' => 'medium',
            'status' => 'active',
            'deadline' => now()->addDays(4),
            'assigned_to' => $operator1->id,
            'created_by' => $manager->id,
            'estimated_hours' => 15,
            'actual_hours' => 9,
            'tags' => ['Optimization', 'Fuel', 'Analytics'],
            'order_column' => 2,
        ]);
        $task7->recordActivity('created', 'Task created', null, $manager);
        $task7->recordActivity('stage_moved', 'Moved to Active Processing', null, $operator1);

        $task8 = Task::create([
            'workflow_id' => $wf2->id,
            'stage_id' => $wf2StageModels['cleared']->id,
            'task_number' => 'TSK-2003',
            'title' => 'Cross-Docking Verification at Singapore Distribution Hub',
            'description' => 'Automated barcode scan reconciliation for 1,200 incoming medical supply pallets.',
            'priority' => 'high',
            'status' => 'completed',
            'deadline' => now()->subDays(3),
            'assigned_to' => $operator2->id,
            'created_by' => $manager->id,
            'estimated_hours' => 8,
            'actual_hours' => 7.5,
            'tags' => ['Singapore', 'Cross-Dock', 'Completed'],
            'order_column' => 3,
        ]);
        $task8->recordActivity('created', 'Task initiated', null, $manager);
        $task8->recordActivity('status_changed', 'Task marked as completed', ['status' => 'completed'], $operator2);

        // 4. Seed Workflow 3: Regulatory Compliance & Governance
        $wf3 = Workflow::create([
            'title' => 'SOC2 Type II & ISO 27001 Annual Recertification',
            'slug' => 'soc2-type-ii-annual-recertification',
            'description' => 'Enterprise compliance evidence collection, access control audits, and cryptographic key rotation verification.',
            'department' => 'Regulatory Compliance',
            'status' => 'active',
            'owner_id' => $admin->id,
            'color' => 'amber',
            'is_starred' => false,
        ]);

        $wf3_stages = [
            ['name' => 'Audit Readiness', 'slug' => 'readiness', 'order' => 1, 'color' => 'slate', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Evidence Gathering', 'slug' => 'gathering', 'order' => 2, 'color' => 'amber', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Third-Party Verification', 'slug' => 'verification', 'order' => 3, 'color' => 'purple', 'is_terminal_success' => false, 'is_blocked_stage' => false],
            ['name' => 'Certified & Signed', 'slug' => 'certified', 'order' => 4, 'color' => 'emerald', 'is_terminal_success' => true, 'is_blocked_stage' => false],
        ];

        $wf3StageModels = [];
        foreach ($wf3_stages as $stageData) {
            $wf3StageModels[$stageData['slug']] = $wf3->stages()->create($stageData);
        }

        $task9 = Task::create([
            'workflow_id' => $wf3->id,
            'stage_id' => $wf3StageModels['gathering']->id,
            'task_number' => 'TSK-3001',
            'title' => 'Quarterly Production Database Privileged Access Review',
            'description' => 'Extract IAM access logs and verify dual-authorization sign-off for all production write operations.',
            'priority' => 'critical',
            'status' => 'active',
            'deadline' => now()->addDays(1),
            'assigned_to' => $admin->id,
            'created_by' => $admin->id,
            'estimated_hours' => 10,
            'actual_hours' => 5,
            'tags' => ['SOC2', 'IAM', 'Compliance'],
            'order_column' => 1,
        ]);
        $task9->recordActivity('created', 'Task started by Alexander Hayes', null, $admin);

        $task10 = Task::create([
            'workflow_id' => $wf3->id,
            'stage_id' => $wf3StageModels['verification']->id,
            'task_number' => 'TSK-3002',
            'title' => 'KMS Key Rotation & Hardware Security Module Validation',
            'description' => 'Validate automated 90-day HSM cryptographic key cycling across all multi-tenant storage volumes.',
            'priority' => 'high',
            'status' => 'active',
            'deadline' => now()->subHours(6), // OVERDUE
            'assigned_to' => $operator1->id,
            'created_by' => $admin->id,
            'estimated_hours' => 14,
            'actual_hours' => 10,
            'tags' => ['HSM', 'Cryptography', 'Audit'],
            'order_column' => 2,
        ]);
        $task10->recordActivity('created', 'Task created', null, $admin);
        $task10->recordActivity('stage_moved', 'Moved to Third-Party Verification', null, $operator1);

        $this->command->info('Enterprise database successfully seeded with workflows, stages, tasks, and audit logs.');
    }
}
