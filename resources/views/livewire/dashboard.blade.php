<div class="space-y-8 pb-10">
    @if (session('status'))
        <div class="rounded-xl bg-emerald-950/40 p-4 border border-emerald-500/30 text-emerald-300">
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

    <!-- Welcome Header -->
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
            <p class="mt-1 text-xs sm:text-sm text-slate-400">{{ now()->format('l, F j, Y') }} &bull; Autonomous Workspace Live</p>
        </div>

        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 px-3 py-1 text-xs font-semibold text-emerald-400">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                AI Triage Active
            </span>
        </div>
    </div>

    <!-- Three Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- My Active Tasks -->
        <div class="bg-slate-950/80 rounded-xl border border-slate-800 p-6 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">My Active Tasks</h3>
                    <p class="text-3xl font-extrabold text-white mt-0.5">{{ $myActiveTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Needs Attention -->
        <div class="bg-slate-950/80 rounded-xl border border-slate-800 p-6 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center">
                <div class="p-3 rounded-xl {{ $myNeedsAttention > 0 ? 'bg-rose-500/10 border border-rose-500/30 text-rose-400' : 'bg-amber-500/10 border border-amber-500/30 text-amber-400' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Needs Attention</h3>
                    <p class="text-3xl font-extrabold text-white mt-0.5">{{ $myNeedsAttention }}</p>
                </div>
            </div>
        </div>

        <!-- Completed This Week -->
        <div class="bg-slate-950/80 rounded-xl border border-slate-800 p-6 shadow-sm hover:border-slate-700 transition-colors">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-teal-500/10 border border-teal-500/20 text-teal-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Completed This Week</h3>
                    <p class="text-3xl font-extrabold text-white mt-0.5">{{ $myCompletedThisWeek }}</p>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="flex-1 space-y-2">
                                <div class="flex flex-wrap items-center gap-2.5">
                                    <span class="font-mono text-xs font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 rounded px-2 py-0.5">
                                        {{ $task->task_number }}
                                    </span>

                                    <h3 class="text-sm sm:text-base font-bold text-white">
                                        <button wire:click="inspectTask({{ $task->id }})" class="hover:text-emerald-400 transition-colors text-left">{{ $task->title }}</button>
                                    </h3>

                                    @if($task->priority === 'critical')
                                        <span class="inline-flex items-center rounded-md bg-rose-500/20 px-2 py-0.5 text-[10px] font-semibold uppercase text-rose-300 border border-rose-500/30">Critical</span>
                                    @elseif($task->priority === 'high')
                                        <span class="inline-flex items-center rounded-md bg-amber-500/20 px-2 py-0.5 text-[10px] font-semibold uppercase text-amber-300 border border-amber-500/30">High</span>
                                    @elseif($task->priority === 'medium')
                                        <span class="inline-flex items-center rounded-md bg-blue-500/20 px-2 py-0.5 text-[10px] font-semibold uppercase text-blue-300 border border-blue-500/30">Medium</span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-slate-800 px-2 py-0.5 text-[10px] font-semibold uppercase text-slate-400 border border-slate-700">Low</span>
                                    @endif

                                    <!-- AI Status Badge -->
                                    @if($task->status === 'blocked')
                                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-500/10 px-2 py-0.5 text-[10px] font-bold text-amber-300 border border-amber-500/20">
                                            Bottleneck Detected
                                        </span>
                                    @elseif($task->status === 'completed')
                                        <span class="inline-flex items-center gap-1 rounded-md bg-teal-500/10 px-2 py-0.5 text-[10px] font-bold text-teal-300 border border-teal-500/20">
                                            Self-Healed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-md bg-emerald-500/10 px-2 py-0.5 text-[10px] font-bold text-emerald-300 border border-emerald-500/20">
                                            Auto-Triaged
                                        </span>
                                    @endif
                                </div>

                                <div class="text-xs text-slate-400 flex flex-wrap items-center gap-x-4 gap-y-1 pt-1">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        {{ $task->workflow->title ?? $task->workflow->name }}
                                    </span>
                                    @if($task->status !== 'completed' && $task->deadline)
                                        <span class="flex items-center gap-1 {{ $task->deadline->isPast() ? 'text-rose-400 font-semibold' : 'text-slate-400' }}">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $task->deadline->isPast() ? 'Overdue by ' . $task->deadline->diffForHumans(['parts' => 1, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) : 'Due ' . $task->deadline->diffForHumans() }}
                                        </span>
                                    @endif
                                    @if($task->status === 'active')
                                        <span class="inline-flex items-center text-emerald-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1.5 animate-pulse"></span> Active
                                        </span>
                                    @elseif($task->status === 'blocked')
                                        <span class="inline-flex items-center text-rose-400 font-semibold">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            Blocked
                                        </span>
                                    @elseif($task->status === 'completed')
                                        <span class="inline-flex items-center text-teal-400 font-semibold">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Completed
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-2 pt-2 sm:pt-0">
                                @if($task->status === 'active')
                                    <button wire:click="completeTask({{ $task->id }})" class="px-3 py-1.5 text-xs font-semibold text-emerald-300 bg-emerald-950/60 hover:bg-emerald-900 border border-emerald-800/80 rounded-lg transition-colors">
                                        Complete
                                    </button>
                                @endif
                                @if($task->status === 'blocked')
                                    <button wire:click="unblockTask({{ $task->id }})" class="px-3 py-1.5 text-xs font-semibold text-teal-300 bg-teal-950/60 hover:bg-teal-900 border border-teal-800/80 rounded-lg transition-colors">
                                        Unblock
                                    </button>
                                @endif
                                <button wire:click="inspectTask({{ $task->id }})" class="px-3 py-1.5 text-xs font-semibold text-slate-300 bg-slate-900 hover:bg-slate-800 border border-slate-700 rounded-lg transition-colors">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-950/80 rounded-xl border border-slate-800 p-10 text-center shadow-sm">
                        <div class="mx-auto w-12 h-12 bg-emerald-950/60 border border-emerald-500/30 text-emerald-400 rounded-2xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-white">You're all caught up! 🎉</h3>
                        <p class="mt-1 text-xs text-slate-400">You don't have any tasks matching this filter.</p>
                        @if($taskFilter !== 'all')
                            <button wire:click="$set('taskFilter', 'all')" class="mt-3 text-xs text-emerald-400 hover:text-emerald-300 font-semibold">View all tasks</button>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar: Recent Activity -->
        <div class="space-y-5">
            <h2 class="text-base font-bold text-white">Recent Activity</h2>
            
            <div class="bg-slate-950/80 rounded-xl border border-slate-800 p-5 shadow-sm">
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

    <!-- Task Detail Modal -->
    <div x-data="{ show: @entangle('showTaskModal') }"
         x-show="show"
         style="display: none;"
         class="relative z-50"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true">
        
        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-950/80 transition-opacity backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="$wire.closeTaskModal()"
                     class="relative transform overflow-hidden rounded-2xl bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-800">
                    
                    @if($selectedTask)
                        <div class="bg-slate-900 px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-800">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 rounded px-2 py-0.5">
                                                {{ $selectedTask->task_number }}
                                            </span>
                                            <h3 class="text-lg font-bold text-white" id="modal-title">
                                                {{ $selectedTask->title }}
                                            </h3>
                                        </div>
                                        <button wire:click="closeTaskModal" class="text-slate-400 hover:text-white transition-colors">
                                            <span class="sr-only">Close</span>
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-2 space-y-4">
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
                            </div>
                        </div>
                        <div class="bg-slate-950/60 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-slate-800">
                            <button wire:click="closeTaskModal" type="button" class="inline-flex w-full justify-center rounded-lg bg-slate-800 px-4 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-700 sm:w-auto transition-colors">
                                Close
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
