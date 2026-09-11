<div class="space-y-8 pb-10">
    @if (session('status'))
        <div class="rounded-xl bg-emerald-950/40 p-4 border border-emerald-500/30 text-emerald-300 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm font-medium">{{ session('status') }}</p>
            </div>
        </div>
    @endif

    <!-- 1. Header with Actions -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-slate-800 pb-5">
        <div>
            @php
                $hour = now()->hour;
                if ($hour < 12) {
                    $greeting = 'Good morning';
                } elseif ($hour < 17) {
                    $greeting = 'Good afternoon';
                } else {
                    $greeting = 'Good evening';
                }
            @endphp
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">{{ $greeting }}, {{ Auth::user()->name }}</h1>
            <p class="mt-1 text-xs sm:text-sm text-slate-400">{{ now()->format('l, F j, Y') }} &bull; TaskVerge Cortex Workspace</p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <button wire:click="openCreateTaskModal" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-600/25 transition-all scale-100 hover:scale-[1.02]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>New Task</span>
            </button>

            <button wire:click="openStandupModal" class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-800/90 hover:bg-slate-700 px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-200 hover:text-white transition-all">
                <svg class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Standup & Export</span>
            </button>
        </div>
    </div>

    <!-- 2. Personal Velocity & Completion Telemetry Strip -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- My Active Tasks -->
        <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-5 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Tasks</span>
                <span class="p-2 rounded-lg bg-emerald-500/10 text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-2">{{ $myActiveTasks }}</p>
            <span class="text-[11px] text-slate-500 mt-1 block">Assigned in flight</span>
        </div>

        <!-- Needs Attention -->
        <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-5 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Needs Attention</span>
                <span class="p-2 rounded-lg {{ $myNeedsAttention > 0 ? 'bg-rose-500/10 text-rose-400' : 'bg-amber-500/10 text-amber-400' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-2">{{ $myNeedsAttention }}</p>
            <span class="text-[11px] {{ $myNeedsAttention > 0 ? 'text-rose-400' : 'text-slate-500' }} mt-1 block">Blocked or overdue</span>
        </div>

        <!-- Completed This Week -->
        <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-5 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Weekly Done</span>
                <span class="p-2 rounded-lg bg-teal-500/10 text-teal-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-2">{{ $myCompletedThisWeek }}</p>
            <span class="text-[11px] text-teal-400 mt-1 block">Since Monday</span>
        </div>

        <!-- On-Time Rate -->
        <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-5 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">On-Time Rate</span>
                <span class="p-2 rounded-lg bg-cyan-500/10 text-cyan-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </span>
            </div>
            <p class="text-3xl font-extrabold text-white mt-2">{{ $onTimeRate }}%</p>
            <span class="text-[11px] text-slate-500 mt-1 block">SLA adherence rate</span>
        </div>

        <!-- Weekly Target Progress -->
        <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-5 shadow-sm hover:border-slate-700 transition-colors sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Sprint Goal</span>
                <span class="text-xs font-bold text-emerald-400">{{ $myCompletedThisWeek }}/{{ $weeklyTarget }}</span>
            </div>
            <div class="w-full bg-slate-900 rounded-full h-2.5 mt-4 overflow-hidden border border-slate-800">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-2.5 rounded-full transition-all duration-500" style="width: {{ $weeklyProgressPercent }}%"></div>
            </div>
            <span class="text-[11px] text-slate-500 mt-2 block">{{ $weeklyProgressPercent }}% of weekly quota</span>
        </div>
    </div>

    <!-- 3. Cortex SLA Radar & Proactive Bottleneck Panel -->
    @if($slaRadarTasks->isNotEmpty())
        <div class="rounded-2xl border border-amber-500/30 bg-gradient-to-r from-slate-950 via-slate-900 to-amber-950/20 p-6 shadow-xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-800/80">
                <div class="flex items-center gap-2.5">
                    <div class="h-8 w-8 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white flex items-center gap-2">
                            Cortex SLA Radar & Bottleneck Detection
                            <span class="rounded-full bg-amber-500/10 border border-amber-500/30 px-2 py-0.5 text-[10px] font-bold text-amber-300">
                                48h Advance Horizon
                            </span>
                        </h2>
                        <p class="text-xs text-slate-400">The following tasks are stalled or approaching critical SLA thresholds.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($slaRadarTasks as $radarTask)
                    <div class="rounded-xl border {{ $radarTask->status === 'blocked' ? 'border-rose-500/40 bg-rose-950/20' : 'border-amber-500/30 bg-slate-950/70' }} p-4 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="font-mono text-xs font-bold {{ $radarTask->status === 'blocked' ? 'text-rose-400' : 'text-amber-300' }}">
                                    {{ $radarTask->task_number }}
                                </span>
                                <span class="text-[11px] font-medium text-slate-400 truncate">
                                    {{ $radarTask->workflow?->name ?? 'General' }} &bull; {{ $radarTask->stage?->name }}
                                </span>
                            </div>
                            <h3 class="text-sm font-bold text-white mb-1.5">{{ $radarTask->title }}</h3>
                            @if($radarTask->blocked_reason)
                                <p class="text-xs text-rose-300 bg-rose-950/40 border border-rose-900/50 rounded-lg p-2 mb-3">
                                    <strong>Blocker:</strong> {{ $radarTask->blocked_reason }}
                                </p>
                            @elseif($radarTask->deadline)
                                <p class="text-xs text-amber-300/90 mb-3">
                                    <strong>Deadline:</strong> Due {{ $radarTask->deadline->diffForHumans() }} ({{ $radarTask->deadline->format('M j, g:i A') }})
                                </p>
                            @endif

                            <!-- AI Blocker Analysis Preview if available -->
                            @if(isset($aiBlockerAnalyses[$radarTask->id]))
                                @php $analysis = $aiBlockerAnalyses[$radarTask->id]; @endphp
                                <div class="rounded-lg bg-slate-900 border border-emerald-500/30 p-3 text-xs mb-3 space-y-1">
                                    <div class="text-emerald-400 font-bold flex items-center justify-between">
                                        <span>✨ Cortex AI Recommendation</span>
                                        <span class="text-[10px] text-slate-400 font-mono">{{ $analysis['source'] }}</span>
                                    </div>
                                    <p class="text-slate-300">{{ $analysis['recommendation'] }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between gap-2 pt-3 border-t border-slate-800/80">
                            @if($radarTask->status === 'blocked')
                                <button wire:click="aiAnalyzeBlocker({{ $radarTask->id }})" wire:loading.attr="disabled" class="text-xs text-emerald-400 hover:text-emerald-300 font-semibold flex items-center gap-1">
                                    @if($analyzingBlockerId === $radarTask->id)
                                        <span>Analyzing with AI...</span>
                                    @else
                                        <span>✨ AI Analyze Blocker</span>
                                    @endif
                                </button>
                                <button wire:click="unblockTask({{ $radarTask->id }})" class="rounded-lg bg-emerald-600 hover:bg-emerald-500 px-3 py-1.5 text-xs font-bold text-white transition-colors">
                                    1-Click Unblock
                                </button>
                            @else
                                <button wire:click="inspectTask({{ $radarTask->id }})" class="text-xs text-slate-400 hover:text-white transition-colors">
                                    Inspect Stage &rarr;
                                </button>
                                <button wire:click="completeTask({{ $radarTask->id }})" class="rounded-lg bg-slate-800 hover:bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-200 hover:text-white transition-colors">
                                    Mark Done
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- 4. Main Section: My Tasks + Sidebar (Workload & Activity) -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Content: My Tasks -->
        <div class="xl:col-span-2 space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-950/60 p-3 rounded-xl border border-slate-800">
                <h2 class="text-base font-bold text-white px-1">My Tasks</h2>
                <div class="flex flex-wrap gap-1.5">
                    @foreach(['all' => 'All', 'active' => 'Active', 'blocked' => 'Blocked', 'overdue' => 'Overdue', 'completed' => 'Completed'] as $value => $label)
                        <button wire:click="$set('taskFilter', '{{ $value }}')" 
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors {{ $taskFilter === $value ? 'bg-emerald-600 text-white shadow-sm shadow-emerald-600/30' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="space-y-3">
                @forelse($myTasks as $task)
                    <div class="bg-slate-950/80 rounded-xl border border-slate-800 p-5 shadow-sm transition-all hover:border-slate-700 hover:shadow-md">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="font-mono text-xs font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 rounded px-1.5 py-0.5">
                                        {{ $task->task_number }}
                                    </span>
                                    <span class="text-xs text-slate-400 truncate">
                                        {{ $task->workflow->name ?? 'General' }} &bull; {{ $task->stage->name ?? 'N/A' }}
                                    </span>
                                </div>
                                <h3 class="text-base font-bold text-white leading-snug truncate">
                                    {{ $task->title }}
                                </h3>

                                <div class="flex flex-wrap items-center gap-3 mt-3 text-xs text-slate-400">
                                    @php
                                        $priorityColors = [
                                            'critical' => 'bg-rose-500/10 text-rose-400 border-rose-500/30',
                                            'high' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                                            'medium' => 'bg-blue-500/10 text-blue-400 border-blue-500/30',
                                            'low' => 'bg-slate-800 text-slate-400 border-slate-700',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded border text-[11px] font-semibold capitalize {{ $priorityColors[$task->priority] ?? 'bg-slate-800 text-slate-400' }}">
                                        {{ $task->priority }}
                                    </span>

                                    @if($task->deadline)
                                        <span class="flex items-center gap-1 {{ $task->isOverdue() ? 'text-rose-400 font-semibold' : 'text-slate-400' }}">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            @if($task->isOverdue())
                                                Overdue by {{ $task->deadline->diffForHumans(null, true) }}
                                            @else
                                                Due {{ $task->deadline->diffForHumans() }}
                                            @endif
                                        </span>
                                    @endif

                                    @if($task->status === 'blocked')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-rose-500/10 text-rose-400 border border-rose-500/30 text-[11px] font-semibold">
                                            Blocked
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 self-end sm:self-center">
                                @if($task->status !== 'completed')
                                    <button wire:click="completeTask({{ $task->id }})" 
                                            class="rounded-lg bg-emerald-600 hover:bg-emerald-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition-colors">
                                        Complete
                                    </button>
                                @endif

                                @if($task->status === 'blocked')
                                    <button wire:click="unblockTask({{ $task->id }})" 
                                            class="rounded-lg bg-slate-800 hover:bg-slate-700 px-3 py-1.5 text-xs font-semibold text-white border border-slate-700 transition-colors">
                                        Unblock
                                    </button>
                                @endif

                                <button wire:click="inspectTask({{ $task->id }})" 
                                        class="rounded-lg bg-slate-900 hover:bg-slate-800 px-3 py-1.5 text-xs font-semibold text-slate-300 border border-slate-800 transition-colors">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-950/40 rounded-xl border border-dashed border-slate-800 p-8 text-center">
                        <p class="text-sm font-semibold text-white">You're all caught up! 🎉</p>
                        <p class="text-xs text-slate-400 mt-1">No tasks matching the selected filter.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar: Team Workload Pulse + Recent Activity -->
        <div class="space-y-6">
            <!-- Team Workload Pulse (Feature 5) -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-white">Team Workload Pulse</h2>
                    <span class="text-[11px] text-slate-500">Live Capacity</span>
                </div>

                <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-4 space-y-3 shadow-sm">
                    @foreach($teamWorkload as $member)
                        <div class="flex items-center justify-between gap-3 text-xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="h-7 w-7 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-[10px] text-slate-300 shrink-0">
                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-white truncate">{{ $member->name }}</p>
                                    <p class="text-[10px] text-slate-400 truncate">{{ $member->department ?: 'Operations' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] font-mono shrink-0">
                                <span class="rounded bg-slate-900 border border-slate-800 px-2 py-0.5 text-emerald-400">
                                    {{ $member->active_count }} active
                                </span>
                                @if($member->blocked_count > 0)
                                    <span class="rounded bg-rose-950/60 border border-rose-800/60 px-1.5 py-0.5 text-rose-400 font-bold">
                                        {{ $member->blocked_count }} !
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="space-y-3">
                <h2 class="text-base font-bold text-white">Recent Activity</h2>
                
                <div class="bg-slate-950/80 rounded-2xl border border-slate-800 p-5 shadow-sm">
                    @if($recentActivity->count() > 0)
                        <div class="flow-root">
                            <ul role="list" class="-mb-6">
                                @foreach($recentActivity as $index => $activity)
                                    <li>
                                        <div class="relative pb-6">
                                            @if(!$loop->last)
                                                <span class="absolute left-3.5 top-3.5 -ml-px h-full w-0.5 bg-slate-800" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex items-start space-x-3">
                                                <div>
                                                    <span class="h-7 w-7 rounded-full bg-slate-900 border border-slate-700 flex items-center justify-center">
                                                        @if(in_array($activity->activity_type, ['created', 'status_changed', 'unblocked']))
                                                            <svg class="h-3.5 w-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        @else
                                                            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="flex min-w-0 flex-1 justify-between space-x-2 pt-0.5">
                                                    <div>
                                                        <p class="text-xs text-slate-200">{{ $activity->description }}</p>
                                                        <p class="mt-0.5 text-[11px] text-slate-400">by {{ $activity->user->name ?? 'System' }} &bull; {{ $activity->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-xs text-slate-400 text-center py-4">No recent activity</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 1: Quick Task Creator Modal (Feature 1) -->
    <div x-data="{ show: @entangle('showCreateTaskModal') }"
         x-show="show"
         x-cloak
         class="relative z-50">
        
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div @click.away="$wire.closeCreateTaskModal()"
                     class="relative transform overflow-hidden rounded-2xl bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-800">
                    
                    <div class="bg-slate-900 px-6 pt-6 pb-4 border-b border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="h-8 w-8 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Create New Task</h3>
                                <p class="text-xs text-slate-400">Fast inline task intake with Cortex AI auto-triage</p>
                            </div>
                        </div>
                        <button wire:click="closeCreateTaskModal" class="text-slate-400 hover:text-white transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit="saveQuickTask" class="p-6 space-y-4">
                        @if (session('triage_error'))
                            <div class="p-3 bg-rose-950/40 border border-rose-500/30 rounded-xl text-xs text-rose-300">
                                {{ session('triage_error') }}
                            </div>
                        @endif

                        <!-- Task Title -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1">Task Title <span class="text-rose-400">*</span></label>
                            <input type="text" wire:model="newTaskTitle" placeholder="e.g. Upgrade PostgreSQL database cluster to v16" 
                                   class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2 text-sm text-white focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500" required>
                            @error('newTaskTitle') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label class="block text-xs font-semibold text-slate-300">Description & Context</label>
                                <button type="button" wire:click="aiSuggestTriage" wire:loading.attr="disabled" class="text-xs text-emerald-400 hover:text-emerald-300 font-semibold flex items-center gap-1 transition-colors">
                                    <span wire:loading.remove wire:target="aiSuggestTriage">✨ AI Auto-Triage</span>
                                    <span wire:loading wire:target="aiSuggestTriage">Analyzing with AI...</span>
                                </button>
                            </div>
                            <textarea wire:model="newTaskDescription" rows="3" placeholder="Provide operational context, logs, or requirements..." 
                                      class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"></textarea>
                        </div>

                        <!-- AI Triage Result Banner -->
                        @if($aiTriageResult)
                            <div class="rounded-xl border border-emerald-500/30 bg-emerald-950/20 p-3 text-xs space-y-1">
                                <div class="flex items-center justify-between text-emerald-400 font-bold">
                                    <span>✨ Auto-Triage Applied</span>
                                    <span class="text-[10px] font-mono text-slate-400">{{ $aiTriageResult['source'] }}</span>
                                </div>
                                <p class="text-slate-300">{{ $aiTriageResult['reasoning'] }}</p>
                                <div class="text-[11px] text-emerald-300 pt-1">
                                    Suggested: <span class="font-bold uppercase">{{ $aiTriageResult['priority'] }}</span> priority &bull; {{ $aiTriageResult['estimated_hours'] }} hrs
                                </div>
                            </div>
                        @endif

                        <!-- Workflow & Stage -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Workflow <span class="text-rose-400">*</span></label>
                                <select wire:model.live="newTaskWorkflowId" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                                    @foreach($availableWorkflows as $wf)
                                        <option value="{{ $wf->id }}">{{ $wf->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Initial Stage <span class="text-rose-400">*</span></label>
                                <select wire:model="newTaskStageId" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                                    @foreach($availableStages as $stg)
                                        <option value="{{ $stg->id }}">{{ $stg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Priority, Assignee, Hours, Deadline -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Priority</label>
                                <select wire:model="newTaskPriority" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-2.5 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none capitalize">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Assignee</label>
                                <select wire:model="newTaskAssigneeId" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-2.5 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                                    <option value="">Unassigned</option>
                                    @foreach($availableUsers as $usr)
                                        <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Hours</label>
                                <input type="number" step="0.5" wire:model="newTaskEstimatedHours" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-2.5 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Deadline</label>
                                <input type="date" wire:model="newTaskDeadline" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-2 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                            </div>
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1">Tags (comma separated)</label>
                            <input type="text" wire:model="newTaskTagsInput" placeholder="e.g. devops, database, security" 
                                   class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                        </div>

                        <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                            <button type="button" wire:click="closeCreateTaskModal" class="rounded-xl bg-slate-800 hover:bg-slate-700 px-4 py-2 text-xs font-semibold text-slate-300 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="rounded-xl bg-emerald-600 hover:bg-emerald-500 px-5 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
                                Create Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 2: 1-Click Standup & Audit Export Modal (Feature 7) -->
    <div x-data="{ show: @entangle('showStandupModal'), copied: false }"
         x-show="show"
         x-cloak
         class="relative z-50">
        
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div @click.away="$wire.closeStandupModal()"
                     class="relative transform overflow-hidden rounded-2xl bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-800">
                    
                    <div class="bg-slate-900 px-6 pt-6 pb-4 border-b border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="h-8 w-8 rounded-xl bg-teal-500/10 border border-teal-500/30 flex items-center justify-center text-teal-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Daily Standup & Audit Export</h3>
                                <p class="text-xs text-slate-400">Executive status report synthesized by Cortex AI</p>
                            </div>
                        </div>
                        <button wire:click="closeStandupModal" class="text-slate-400 hover:text-white transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="relative">
                            <pre class="w-full rounded-xl border border-slate-800 bg-slate-950 p-4 font-mono text-xs text-slate-200 overflow-x-auto whitespace-pre-wrap leading-relaxed max-h-72">{{ $standupMarkdown }}</pre>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                            <button wire:click="exportTasksCsv" class="inline-flex items-center gap-1.5 text-xs text-slate-300 hover:text-white transition-colors">
                                <svg class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                <span>Download CSV Export</span>
                            </button>

                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        @click="navigator.clipboard.writeText($wire.standupMarkdown); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.842A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.592m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                                    </svg>
                                    <span x-text="copied ? 'Copied to Clipboard! 🎉' : 'Copy for Slack / Teams'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 3: Task Detail Inspection Modal -->
    <div x-data="{ show: @entangle('showTaskModal') }"
         x-show="show"
         x-cloak
         class="relative z-50">
        
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div @click.away="$wire.closeTaskModal()"
                     class="relative transform overflow-hidden rounded-2xl bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-800">
                    
                    @if($selectedTask)
                        <div class="bg-slate-900 px-6 pt-6 pb-4 border-b border-slate-800">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 rounded px-2 py-0.5">
                                        {{ $selectedTask->task_number }}
                                    </span>
                                    <h3 class="text-lg font-bold text-white">
                                        {{ $selectedTask->title }}
                                    </h3>
                                </div>
                                <button wire:click="closeTaskModal" class="text-slate-400 hover:text-white transition-colors">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="space-y-4">
                                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed bg-slate-950/60 border border-slate-800 rounded-xl p-3.5">{{ $selectedTask->description ?: 'No description provided.' }}</p>
                                
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs mt-4">
                                    <div class="bg-slate-950/40 p-2.5 rounded-lg border border-slate-800/80">
                                        <span class="block text-slate-500 uppercase text-[10px] font-semibold mb-0.5">Status</span>
                                        <span class="font-semibold text-white capitalize">{{ $selectedTask->status }}</span>
                                    </div>
                                    <div class="bg-slate-950/40 p-2.5 rounded-lg border border-slate-800/80">
                                        <span class="block text-slate-500 uppercase text-[10px] font-semibold mb-0.5">Priority</span>
                                        <span class="font-semibold text-white capitalize">{{ $selectedTask->priority }}</span>
                                    </div>
                                    <div class="bg-slate-950/40 p-2.5 rounded-lg border border-slate-800/80">
                                        <span class="block text-slate-500 uppercase text-[10px] font-semibold mb-0.5">Stage</span>
                                        <span class="font-semibold text-white">{{ $selectedTask->stage->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="bg-slate-950/40 p-2.5 rounded-lg border border-slate-800/80">
                                        <span class="block text-slate-500 uppercase text-[10px] font-semibold mb-0.5">Assignee</span>
                                        <span class="font-semibold text-white">{{ $selectedTask->assignee->name ?? 'Unassigned' }}</span>
                                    </div>
                                </div>

                                @if($selectedTask->activities->count() > 0)
                                    <div class="mt-6">
                                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Audit History</h4>
                                        <div class="space-y-2 max-h-52 overflow-y-auto pr-1">
                                            @foreach($selectedTask->activities as $activity)
                                                <div class="text-xs bg-slate-950/40 p-2 rounded-lg border border-slate-800/60">
                                                    <p class="text-slate-200">{{ $activity->description }}</p>
                                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                                        {{ $activity->user->name ?? 'System' }} &bull; {{ $activity->created_at->format('M j, Y g:i A') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="bg-slate-950/60 px-6 py-3 flex justify-end border-t border-slate-800">
                            <button wire:click="closeTaskModal" type="button" class="rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-700 transition-colors">
                                Close
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
