<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Subscription Plans & Limits
    |--------------------------------------------------------------------------
    |
    | Centralized configuration for all subscription tiers. Each plan defines
    | the maximum number of users, workflows, tasks, copilot queries, analytics
    | history, and pricing. A null value means unlimited.
    |
    */

    'free' => [
        'label' => 'Free Trial',
        'badge' => 'Trial',
        'max_users' => 3,
        'max_workflows' => 3,
        'max_tasks' => 50,
        'copilot_queries' => 20,
        'analytics_days' => 7,
        'audit_retention_days' => 7,
        'duration_days' => 14,
        'price_monthly' => 0,
        'price_yearly' => 0,
        'features' => [
            'Up to 3 team members',
            'Up to 3 active workflows',
            '50 total tasks with Kanban views',
            '20 AI Copilot queries / month',
            '7-day analytics history & basic telemetry',
            '7-day compliance audit trail',
            'Community support',
        ],
    ],

    'core' => [
        'label' => 'Operations Core',
        'badge' => 'Most Popular',
        'max_users' => 25,
        'max_workflows' => null,
        'max_tasks' => null,
        'copilot_queries' => 500,
        'analytics_days' => 90,
        'audit_retention_days' => 90,
        'duration_days' => null,
        'price_monthly' => 49,
        'price_yearly' => 468, // $39/mo billed annually
        'features' => [
            'Up to 25 team members',
            'Unlimited workflows & tasks',
            '500 AI Copilot queries / month',
            '90-day analytics & SLA breach projections',
            'Team Capacity Hub & workload rebalancing',
            '90-day compliance audit retention & CSV export',
            'Predictive Bottleneck Radar (48h horizon)',
            'Expedited support SLA (< 4 hours)',
        ],
    ],

    'intelligence' => [
        'label' => 'Enterprise',
        'badge' => 'Enterprise Scale',
        'max_users' => null,
        'max_workflows' => null,
        'max_tasks' => null,
        'copilot_queries' => null, // Unlimited
        'analytics_days' => null,  // Unlimited
        'audit_retention_days' => null, // Unlimited
        'duration_days' => null,
        'price_monthly' => 119,
        'price_yearly' => 1140, // $95/mo billed annually
        'features' => [
            'Unlimited team members & departments',
            'Unlimited workflows & tasks',
            'Unlimited AI Copilot queries & custom LLM keys',
            'Unlimited analytics history & predictive forecasting',
            'Enterprise Team Hub with multi-department routing',
            'Permanent immutable audit trail & compliance export',
            'Advanced Admin Panel with custom RBAC permissions',
            '24/7 dedicated support & 99.9% uptime SLA',
        ],
    ],

];
