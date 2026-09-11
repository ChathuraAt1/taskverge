<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Subscription Plans & Limits
    |--------------------------------------------------------------------------
    |
    | Centralized configuration for all subscription tiers. Each plan defines
    | the maximum number of users, workflows, tasks, and pricing. A null
    | value means unlimited.
    |
    */

    'free' => [
        'label' => 'Free Trial',
        'max_users' => 3,
        'max_workflows' => 3,
        'max_tasks' => 50,
        'duration_days' => 14,
        'price_monthly' => 0,
        'price_yearly' => 0,
    ],

    'core' => [
        'label' => 'Operations Core',
        'max_users' => 25,
        'max_workflows' => null,
        'max_tasks' => null,
        'duration_days' => null,
        'price_monthly' => 49,
        'price_yearly' => 470,
    ],

    'intelligence' => [
        'label' => 'Enterprise',
        'max_users' => null,
        'max_workflows' => null,
        'max_tasks' => null,
        'duration_days' => null,
        'price_monthly' => 119,
        'price_yearly' => 1140,
    ],

];
