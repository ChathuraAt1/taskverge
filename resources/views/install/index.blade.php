<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database & System Installer - TaskVerge</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-950 text-slate-200 font-sans flex flex-col justify-between" x-data="{ confirmingAction: null }">

    <!-- Top Header -->
    <header class="border-b border-slate-800 bg-slate-900/60 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-500/20">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white">Task<span class="text-emerald-400">Verge</span></span>
                </a>
                <span class="rounded-full bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-0.5 text-xs font-semibold text-emerald-400">
                    System Installer
                </span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">
                    &larr; Back to Landing
                </a>
                <a href="{{ route('login') }}" class="rounded-lg bg-slate-800 hover:bg-slate-700 px-3 py-1.5 text-xs font-medium text-white transition-colors">
                    Login
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex-1">
        <!-- Security Notice -->
        <div class="mb-8 rounded-2xl border border-amber-500/30 bg-amber-500/10 p-4 text-sm text-amber-300 flex items-start gap-3.5">
            <svg class="h-5 w-5 shrink-0 text-amber-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <div class="space-y-1">
                <div class="font-semibold text-amber-200">Installer Route is Currently Enabled</div>
                <p class="text-xs text-amber-300/90 leading-relaxed">
                    This endpoint is active because <code class="px-1.5 py-0.5 rounded bg-amber-950/60 font-mono text-amber-200">ENABLE_INSTALLER_ROUTE=true</code> is set in your <code class="px-1.5 py-0.5 rounded bg-amber-950/60 font-mono text-amber-200">.env</code> file. For security in production, set <code class="px-1.5 py-0.5 rounded bg-amber-950/60 font-mono text-amber-200">ENABLE_INSTALLER_ROUTE=false</code> once database setup is complete.
                </p>
            </div>
        </div>

        <!-- System & Database Status Grid -->
        <div class="mb-8 rounded-2xl border border-slate-800 bg-slate-900/60 p-6 shadow-xl">
            <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                Environment & Database Connectivity
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="rounded-xl border border-slate-800/80 bg-slate-950/60 p-3">
                    <div class="text-[11px] font-medium text-slate-400">PHP Version</div>
                    <div class="text-sm font-semibold text-white mt-1">{{ $systemInfo['php_version'] }}</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-950/60 p-3">
                    <div class="text-[11px] font-medium text-slate-400">Laravel</div>
                    <div class="text-sm font-semibold text-white mt-1">v{{ $systemInfo['laravel_version'] }}</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-950/60 p-3">
                    <div class="text-[11px] font-medium text-slate-400">Environment</div>
                    <div class="text-sm font-semibold text-emerald-400 mt-1 uppercase tracking-wider">{{ $systemInfo['app_env'] }}</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-950/60 p-3">
                    <div class="text-[11px] font-medium text-slate-400">Driver</div>
                    <div class="text-sm font-semibold text-white mt-1 uppercase">{{ $systemInfo['db_connection'] }}</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-950/60 p-3">
                    <div class="text-[11px] font-medium text-slate-400">Database</div>
                    <div class="text-sm font-semibold text-white mt-1 font-mono truncate" title="{{ $systemInfo['db_database'] }}">{{ $systemInfo['db_database'] }}</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-950/60 p-3">
                    <div class="text-[11px] font-medium text-slate-400">Connection</div>
                    <div class="text-sm font-semibold mt-1 flex items-center gap-1.5">
                        @if($systemInfo['db_connected'])
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-emerald-400">Connected</span>
                        @else
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                            <span class="text-rose-400">Error</span>
                        @endif
                    </div>
                </div>
            </div>

            @if(!$systemInfo['db_connected'] && $systemInfo['db_error'])
                <div class="mt-4 rounded-xl border border-rose-500/30 bg-rose-500/10 p-3 text-xs text-rose-300 font-mono">
                    {{ $systemInfo['db_error'] }}
                </div>
            @endif
        </div>

        <!-- Action Cards Grid -->
        <div class="mb-10">
            <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
                Available Database Operations
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- 1. Migration Force -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-5 flex flex-col justify-between hover:border-slate-700 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Schema Update</span>
                            <span class="rounded bg-slate-800 px-2 py-0.5 font-mono text-[11px] text-slate-300">migrate --force</span>
                        </div>
                        <h3 class="text-base font-bold text-white mb-1.5">Migration Force</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mb-4">
                            Safely executes all outstanding database migrations. Existing tables and user records are preserved.
                        </p>
                    </div>
                    <form method="POST" action="{{ route('install.execute') }}">
                        @csrf
                        <input type="hidden" name="action" value="migrate">
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2.5 text-xs font-bold text-white shadow-lg shadow-emerald-600/20 transition-all flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                            </svg>
                            Run Migration Force
                        </button>
                    </form>
                </div>

                <!-- 2. Fresh Migration Force -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-5 flex flex-col justify-between hover:border-slate-700 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Schema Reset</span>
                            <span class="rounded bg-slate-800 px-2 py-0.5 font-mono text-[11px] text-slate-300">migrate:fresh --force</span>
                        </div>
                        <h3 class="text-base font-bold text-white mb-1.5">Fresh Migration Force</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mb-4">
                            <strong class="text-amber-300">Destructive:</strong> Drops all database tables and runs every migration from scratch. All existing data is erased.
                        </p>
                    </div>
                    <form method="POST" action="{{ route('install.execute') }}" onsubmit="return confirm('⚠️ WARNING: This will DROP ALL TABLES and ERASE all data in the database. Are you sure you want to run migrate:fresh?');">
                        @csrf
                        <input type="hidden" name="action" value="migrate_fresh">
                        <button type="submit" class="w-full rounded-xl border border-amber-500/40 bg-amber-500/10 hover:bg-amber-500/20 px-4 py-2.5 text-xs font-bold text-amber-300 transition-all flex items-center justify-center gap-2">
                            <svg class="h-4 w-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Run Fresh Migration (Force)
                        </button>
                    </form>
                </div>

                <!-- 3. Seed Database -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-5 flex flex-col justify-between hover:border-slate-700 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-teal-400">Data Seeding</span>
                            <span class="rounded bg-slate-800 px-2 py-0.5 font-mono text-[11px] text-slate-300">db:seed --force</span>
                        </div>
                        <h3 class="text-base font-bold text-white mb-1.5">Seed Database (Force)</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mb-4">
                            Runs <code class="font-mono text-slate-300">DatabaseSeeder</code> to populate initial users, superadmin account, demo workflows, and standard configuration.
                        </p>
                    </div>
                    <form method="POST" action="{{ route('install.execute') }}">
                        @csrf
                        <input type="hidden" name="action" value="seed">
                        <button type="submit" class="w-full rounded-xl bg-teal-600 hover:bg-teal-500 px-4 py-2.5 text-xs font-bold text-white shadow-lg shadow-teal-600/20 transition-all flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
                            </svg>
                            Run Database Seed (Force)
                        </button>
                    </form>
                </div>

                <!-- 4. Fresh Migration & Seed Force -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-5 flex flex-col justify-between hover:border-slate-700 transition-colors">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-rose-400">Complete Reset & Seed</span>
                            <span class="rounded bg-slate-800 px-2 py-0.5 font-mono text-[11px] text-slate-300">migrate:fresh --seed --force</span>
                        </div>
                        <h3 class="text-base font-bold text-white mb-1.5">Fresh Migration & Seed</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mb-4">
                            <strong class="text-rose-300">Full Wipe & Install:</strong> Completely wipes the database, recreates all tables, and seeds fresh demo records and admin accounts.
                        </p>
                    </div>
                    <form method="POST" action="{{ route('install.execute') }}" onsubmit="return confirm('🚨 CRITICAL WARNING: This will COMPLETELY WIPE the database, re-run all migrations, and re-seed all tables. Proceed?');">
                        @csrf
                        <input type="hidden" name="action" value="fresh_seed">
                        <button type="submit" class="w-full rounded-xl border border-rose-500/40 bg-rose-500/10 hover:bg-rose-500/20 px-4 py-2.5 text-xs font-bold text-rose-300 transition-all flex items-center justify-center gap-2">
                            <svg class="h-4 w-4 text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            Run Fresh Seed (Force)
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Command Execution Output Terminal -->
        @if(session('install_result'))
            @php $res = session('install_result'); @endphp
            <div class="rounded-2xl border border-slate-800 bg-slate-900/80 p-6 shadow-2xl">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-800">
                    <div class="flex items-center gap-2.5">
                        <div class="h-3 w-3 rounded-full {{ $res['success'] ? 'bg-emerald-400' : 'bg-rose-500' }}"></div>
                        <h3 class="text-sm font-bold text-white font-mono">{{ $res['label'] }}</h3>
                    </div>
                    <div class="flex items-center gap-4 text-xs font-mono">
                        <span class="text-slate-400">{{ $res['timestamp'] }}</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-slate-300">{{ $res['duration'] }} ms</span>
                        @if($res['success'])
                            <span class="rounded-full bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-0.5 text-emerald-400 font-bold text-[11px]">
                                SUCCESS
                            </span>
                        @else
                            <span class="rounded-full bg-rose-500/10 border border-rose-500/30 px-2.5 py-0.5 text-rose-400 font-bold text-[11px]">
                                FAILED
                            </span>
                        @endif
                    </div>
                </div>

                <div class="relative">
                    <pre class="rounded-xl bg-slate-950 p-4 font-mono text-xs text-slate-300 overflow-x-auto whitespace-pre-wrap leading-relaxed border border-slate-800/80">{{ $res['output'] }}</pre>
                </div>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-900 py-6 text-center text-xs text-slate-600">
        TaskVerge Autonomous Workflow Intelligence &bull; Database & System Setup Utility
    </footer>

</body>
</html>
