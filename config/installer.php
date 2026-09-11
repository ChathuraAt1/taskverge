<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Database & Schema Installer Route Enabled
    |--------------------------------------------------------------------------
    |
    | When enabled via ENABLE_INSTALLER_ROUTE=true in .env, the /install route
    | is accessible to run database migrations and seeders. When disabled or
    | unset, the route immediately returns a 404 response.
    |
    */
    'enabled' => filter_var(env('ENABLE_INSTALLER_ROUTE', false), FILTER_VALIDATE_BOOLEAN),
];
