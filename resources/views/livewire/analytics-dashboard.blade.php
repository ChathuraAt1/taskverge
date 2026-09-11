<div class="space-y-6">
    <!-- Top Header & Time Range Filter -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="h-8 w-8 rounded-xl bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-400 shadow-md">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-white tracking-tight">Analytics &amp; SLA Telemetry</h2>
                    <p class="text-xs text-slate-400">Enterprise throughput, cycle velocity, and bottleneck risk metrics</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <!-- Range Selector Buttons -->
            <div class="inline-flex rounded-xl bg-slate-950 border border-slate-800 p-1 text-xs">
                <button 
                    wire:click="setRange('7d')" 
                    class="px-3 py-1.5 rounded-lg font-bold transition-all {{ $timeRange === '7d' ? 'bg-emerald-600 text-white shadow-sm' : 'text-slate-400 hover:text-white' }}"
                >
                    7 Days
                </button>
                <button 
                    wire:click="setRange('30d')" 
                    class="px-3 py-1.5 rounded-lg font-bold transition-all {{ $timeRange === '30d' ? 'bg-emerald-600 text-white shadow-sm' : 'text-slate-400 hover:text-white' }}"
                >
                    30 Days
                </button>
                <button 
                    wire:click="setRange('90d')" 
                    class="px-3 py-1.5 rounded-lg font-bold transition-all {{ $timeRange === '90d' ? 'bg-emerald-600 text-white shadow-sm' : 'text-slate-400 hover:text-white' }}"
                >
                    90 Days
                </button>
            </div>

            <span class="text-[11px] text-slate-500 font-mono">
                Tier: <strong class="text-slate-300">{{ $planConfig['label'] }}</strong> ({{ $user->getAnalyticsHistoryDays() ? $user->getAnalyticsHistoryDays() . 'd retention' : 'Unlimited' }})
            </span>
        </div>
    </div>

    @if (session('analytics_gate'))
        <div class="rounded-xl border border-amber-500/30 bg-amber-500/10 p-4 text-xs text-amber-300 flex items-center justify-between shadow-md">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-amber-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ session('analytics_gate') }}</span>
            </div>
            <a href="{{ route('checkout') }}?plan=core" class="rounded-lg bg-amber-500 hover:bg-amber-400 px-3 py-1.5 text-xs font-bold text-slate-950 transition-colors whitespace-nowrap">
                Upgrade to Core &rarr;
            </a>
        </div>
    @endif

    <!-- 4 Key Telemetry Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- 1. On-Time Delivery Rate -->
        <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="font-semibold uppercase tracking-wider text-[11px]">On-Time Delivery SLA</span>
                <span class="rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 px-2 py-0.5 text-[10px] font-bold">Target: 95%</span>
            </div>
            <div class="text-3xl font-extrabold text-white">{{ $onTimeRate }}%</div>
            <div class="flex items-center gap-1.5 text-xs text-emerald-400">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                </svg>
                <span>Adherence to milestone deadlines</span>
            </div>
        </div>

        <!-- 2. Average Cycle Time -->
        <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="font-semibold uppercase tracking-wider text-[11px]">Average Cycle Time</span>
                <span class="rounded bg-blue-500/10 text-blue-400 border border-blue-500/30 px-2 py-0.5 text-[10px] font-bold">Intake &rarr; Release</span>
            </div>
            <div class="text-3xl font-extrabold text-white">{{ $avgCycleDays }} <span class="text-sm font-normal text-slate-400">days</span></div>
            <div class="text-xs text-slate-400">Time from creation to resolution</div>
        </div>

        <!-- 3. Total Completed in Window -->
        <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="font-semibold uppercase tracking-wider text-[11px]">Completed Throughput</span>
                <span class="rounded bg-teal-500/10 text-teal-400 border border-teal-500/30 px-2 py-0.5 text-[10px] font-bold">In Window</span>
            </div>
            <div class="text-3xl font-extrabold text-white">{{ $totalCompleted }} <span class="text-sm font-normal text-slate-400">tasks</span></div>
            <div class="text-xs text-slate-400">Resolved work items</div>
        </div>

        <!-- 4. Bottleneck Exposure Rate -->
        <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="font-semibold uppercase tracking-wider text-[11px]">Bottleneck Exposure</span>
                <span class="rounded bg-rose-500/10 text-rose-400 border border-rose-500/30 px-2 py-0.5 text-[10px] font-bold">Impediments</span>
            </div>
            <div class="text-3xl font-extrabold text-white">{{ $bottleneckRate }}%</div>
            <div class="text-xs text-slate-400">Tasks hitting blocker stages</div>
        </div>
    </div>

    <!-- Workflow Performance Matrix -->
    <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-6 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-white">Pipeline Execution &amp; Throughput</h3>
                <p class="text-xs text-slate-400">Real-time status across enterprise active workflows</p>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($workflows as $wf)
                <div class="rounded-xl border border-slate-800/80 bg-slate-900/60 p-4 space-y-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                            <span class="text-sm font-bold text-white">{{ $wf['title'] }}</span>
                            <span class="text-xs text-slate-400">({{ $wf['department'] }})</span>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-mono">
                            <span class="text-slate-300">Active: <strong class="text-white">{{ $wf['active'] }}</strong></span>
                            <span class="text-slate-300">Blocked: <strong class="text-rose-400">{{ $wf['blocked'] }}</strong></span>
                            <span class="text-slate-300">Completed: <strong class="text-emerald-400">{{ $wf['completed'] }}</strong></span>
                            <span class="text-slate-300 font-bold">Progress: {{ $wf['completion_percent'] }}%</span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="h-2 w-full rounded-full bg-slate-800 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full transition-all duration-500" style="width: {{ $wf['completion_percent'] }}%;"></div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-xs text-slate-400">No active workflows to analyze.</div>
            @endforelse
        </div>
    </div>

    <!-- Department Distribution Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-6 space-y-4">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider">Department Task Distribution</h3>
            <div class="space-y-3 text-xs">
                @forelse($departmentDistribution as $dept => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-slate-300 font-medium">{{ $dept ?: 'General' }}</span>
                        <span class="rounded bg-slate-800 px-2.5 py-1 font-mono text-white">{{ $count }} tasks</span>
                    </div>
                @empty
                    <div class="text-slate-500 text-xs">No distribution data recorded.</div>
                @endforelse
            </div>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider">Cortex SLA Advisory</h3>
            <p class="text-xs text-slate-300 leading-relaxed">
                TaskVerge telemetry monitors inter-stage handoffs continuously. To minimize cycle time and avoid SLA breaches, focus unblocking resources on tasks held in <em>Impediment Block</em> and <em>Customs Hold</em> stages.
            </p>
            <div class="pt-2">
                <a href="{{ route('copilot') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-400 hover:text-emerald-300">
                    <span>Ask Cortex Copilot for SLA optimization strategies &rarr;</span>
                </a>
            </div>
        </div>
    </div>
</div>
