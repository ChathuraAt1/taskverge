<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InstallController extends Controller
{
    /**
     * Display the database & system installer dashboard.
     */
    public function index(): View
    {
        abort_unless(config('installer.enabled', false), 404);

        $dbConnected = false;
        $dbError = null;

        try {
            DB::connection()->getPdo();
            $dbConnected = true;
        } catch (\Throwable $e) {
            $dbError = $e->getMessage();
        }

        $systemInfo = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'app_env' => app()->environment(),
            'app_debug' => config('app.debug') ? 'Enabled' : 'Disabled',
            'db_connection' => config('database.default'),
            'db_host' => config('database.connections.' . config('database.default') . '.host'),
            'db_database' => config('database.connections.' . config('database.default') . '.database'),
            'db_username' => config('database.connections.' . config('database.default') . '.username'),
            'db_connected' => $dbConnected,
            'db_error' => $dbError,
        ];

        return view('install.index', [
            'systemInfo' => $systemInfo,
        ]);
    }

    /**
     * Execute the selected migration/seed operation.
     */
    public function execute(Request $request): RedirectResponse
    {
        abort_unless(config('installer.enabled', false), 404);

        $validated = $request->validate([
            'action' => ['required', 'string', 'in:migrate,migrate_fresh,seed,fresh_seed'],
        ]);

        $action = $validated['action'];
        $startTime = microtime(true);
        $success = true;
        $output = '';
        $label = '';

        try {
            switch ($action) {
                case 'migrate':
                    $label = 'Migration Force (migrate --force)';
                    $exitCode = Artisan::call('migrate', ['--force' => true]);
                    break;

                case 'migrate_fresh':
                    $label = 'Fresh Migration Force (migrate:fresh --force)';
                    $exitCode = Artisan::call('migrate:fresh', ['--force' => true]);
                    break;

                case 'seed':
                    $label = 'Database Seed Force (db:seed --force)';
                    $exitCode = Artisan::call('db:seed', ['--force' => true]);
                    break;

                case 'fresh_seed':
                    $label = 'Fresh Migration & Seed Force (migrate:fresh --seed --force)';
                    $exitCode = Artisan::call('migrate:fresh', [
                        '--seed' => true,
                        '--force' => true,
                    ]);
                    break;

                default:
                    abort(400, 'Invalid installer action.');
            }

            $output = Artisan::output();
            if ($exitCode !== 0) {
                $success = false;
            }
        } catch (\Throwable $e) {
            $success = false;
            $output = $e->getMessage() . "\n\n" . $e->getTraceAsString();
        }

        $duration = round((microtime(true) - $startTime) * 1000, 2);

        return redirect()->route('install.index')->with('install_result', [
            'action' => $action,
            'label' => $label,
            'success' => $success,
            'output' => trim($output) ?: 'Command completed with return code 0 (No stdout produced).',
            'duration' => $duration,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
