<div class="space-y-8 pb-10">
    @if (session('status'))
        <div class="rounded-md bg-emerald-50 p-4 border border-emerald-200 dark:bg-emerald-900/30 dark:border-emerald-800">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800 dark:text-emerald-300">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
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
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $greeting }}, {{ Auth::user()->name }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ now()->format('l, F j, Y') }}</p>
        </div>
    </div>

    <!-- Three Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- My Active Tasks -->
        <div class="bg-white dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">My Active Tasks</h3>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $myActiveTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Needs Attention -->
        <div class="bg-white dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-lg {{ $myNeedsAttention > 0 ? 'bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400' : 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">Needs Attention</h3>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $myNeedsAttention }}</p>
                </div>
            </div>
        </div>

        <!-- Completed This Week -->
        <div class="bg-white dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">Completed This Week</h3>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $myCompletedThisWeek }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Content: My Tasks -->
        <div class="xl:col-span-2 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">My Tasks</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach(['all' => 'All', 'active' => 'Active', 'blocked' => 'Blocked', 'overdue' => 'Overdue', 'completed' => 'Completed'] as $value => $label)
                        <button wire:click="$set('taskFilter', '{{ $value }}')" 
                                class="px-3 py-1.5 text-sm font-medium rounded-md transition-colors {{ $taskFilter === $value ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800/50' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="space-y-4">
                @forelse($myTasks as $task)
                    <div class="bg-white dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm transition-all hover:shadow-md">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                        <button wire:click="inspectTask({{ $task->id }})" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors text-left">{{ $task->title }}</button>
                                    </h3>
                                    @if($task->priority === 'critical')
                                        <span class="inline-flex items-center rounded-full bg-rose-50 px-2 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-600/20 dark:bg-rose-900/30 dark:text-rose-400 dark:ring-rose-900/50">Critical</span>
                                    @elseif($task->priority === 'high')
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20 dark:bg-amber-900/30 dark:text-amber-400 dark:ring-amber-900/50">High</span>
                                    @elseif($task->priority === 'medium')
                                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-400 dark:ring-blue-900/50">Medium</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-slate-50 px-2 py-1 text-xs font-medium text-slate-600 ring-1 ring-inset ring-slate-500/10 dark:bg-slate-800/50 dark:text-slate-400 dark:ring-slate-700">Low</span>
                                    @endif
                                </div>
                                <div class="text-sm text-slate-500 dark:text-slate-400 flex flex-wrap items-center gap-x-4 gap-y-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        {{ $task->workflow->name }}
                                    </span>
                                    @if($task->status !== 'completed' && $task->deadline)
                                        <span class="flex items-center gap-1 {{ $task->deadline->isPast() ? 'text-rose-600 dark:text-rose-400 font-medium' : '' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $task->deadline->isPast() ? 'Overdue by ' . $task->deadline->diffForHumans(['parts' => 1, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) : 'Due ' . $task->deadline->diffForHumans() }}
                                        </span>
                                    @endif
                                    @if($task->status === 'active')
                                        <span class="inline-flex items-center text-indigo-600 dark:text-indigo-400">
                                            <span class="w-2 h-2 rounded-full bg-indigo-500 mr-1.5 animate-pulse"></span> Active
                                        </span>
                                    @elseif($task->status === 'blocked')
                                        <span class="inline-flex items-center text-amber-600 dark:text-amber-400">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            Blocked
                                        </span>
                                    @elseif($task->status === 'completed')
                                        <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Completed
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($task->status === 'active')
                                    <button wire:click="completeTask({{ $task->id }})" class="px-3 py-1.5 text-sm font-medium text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:text-emerald-300 dark:bg-emerald-900/50 dark:hover:bg-emerald-900 border border-emerald-200 dark:border-emerald-800 rounded-md transition-colors">
                                        Complete
                                    </button>
                                @endif
                                @if($task->status === 'blocked')
                                    <button wire:click="unblockTask({{ $task->id }})" class="px-3 py-1.5 text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:text-indigo-300 dark:bg-indigo-900/50 dark:hover:bg-indigo-900 border border-indigo-200 dark:border-indigo-800 rounded-md transition-colors">
                                        Unblock
                                    </button>
                                @endif
                                <button wire:click="inspectTask({{ $task->id }})" class="px-3 py-1.5 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 dark:text-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 rounded-md transition-colors">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-800 p-10 text-center shadow-sm">
                        <div class="mx-auto w-16 h-16 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900 dark:text-white">You're all caught up! 🎉</h3>
                        <p class="mt-2 text-slate-500 dark:text-slate-400">You don't have any tasks matching this filter.</p>
                        @if($taskFilter !== 'all')
                            <button wire:click="$set('taskFilter', 'all')" class="mt-4 text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">View all tasks</button>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar: Recent Activity -->
        <div class="space-y-6">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Recent Activity</h2>
            
            <div class="bg-white dark:bg-slate-900/80 rounded-xl border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                @if($recentActivity->count() > 0)
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($recentActivity as $index => $activity)
                                <li>
                                    <div class="relative pb-8">
                                        @if(!$loop->last)
                                            <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-slate-200 dark:bg-slate-800" aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center ring-8 ring-white dark:ring-slate-900/80">
                                                    @if(in_array($activity->activity_type, ['created', 'status_changed', 'unblocked']))
                                                        <svg class="h-4 w-4 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @else
                                                        <svg class="h-4 w-4 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-slate-900 dark:text-white">{{ $activity->description }} <span class="text-slate-500 dark:text-slate-400">on <a href="#" wire:click.prevent="inspectTask({{ $activity->task->id }})" class="font-medium text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">{{ str($activity->task->title)->limit(20) }}</a></span></p>
                                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">by {{ $activity->user->name ?? 'System' }} &bull; {{ $activity->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p class="text-sm text-slate-500 dark:text-slate-400 text-center py-4">No recent activity</p>
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
             class="fixed inset-0 bg-slate-950/75 transition-opacity backdrop-blur-sm"></div>

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
                     class="relative transform overflow-hidden rounded-xl bg-white dark:bg-slate-900 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-200 dark:border-slate-800">
                    
                    @if($selectedTask)
                        <div class="bg-white dark:bg-slate-900 px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-200 dark:border-slate-800">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-semibold leading-6 text-slate-900 dark:text-white" id="modal-title">
                                            {{ $selectedTask->title }}
                                        </h3>
                                        <button wire:click="closeTaskModal" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300 transition-colors">
                                            <span class="sr-only">Close</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-2 space-y-4">
                                        <p class="text-sm text-slate-600 dark:text-slate-300 whitespace-pre-wrap">{{ $selectedTask->description ?: 'No description provided.' }}</p>
                                        
                                        <div class="grid grid-cols-2 gap-4 text-sm mt-6">
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Status</span>
                                                <span class="font-medium text-slate-900 dark:text-white capitalize">{{ $selectedTask->status }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Priority</span>
                                                <span class="font-medium text-slate-900 dark:text-white capitalize">{{ $selectedTask->priority }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Workflow</span>
                                                <span class="font-medium text-slate-900 dark:text-white">{{ $selectedTask->workflow->name }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Stage</span>
                                                <span class="font-medium text-slate-900 dark:text-white">{{ $selectedTask->stage->name ?? 'N/A' }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Assignee</span>
                                                <span class="font-medium text-slate-900 dark:text-white">{{ $selectedTask->assignee->name ?? 'Unassigned' }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Creator</span>
                                                <span class="font-medium text-slate-900 dark:text-white">{{ $selectedTask->creator->name ?? 'System' }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Deadline</span>
                                                <span class="font-medium text-slate-900 dark:text-white">
                                                    {{ $selectedTask->deadline ? $selectedTask->deadline->format('M j, Y g:i A') : 'None' }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="block text-slate-500 dark:text-slate-400 mb-1">Est. Hours</span>
                                                <span class="font-medium text-slate-900 dark:text-white">{{ $selectedTask->estimated_hours ?? 'N/A' }}</span>
                                            </div>
                                        </div>

                                        @if($selectedTask->activities->count() > 0)
                                            <div class="mt-8">
                                                <h4 class="text-sm font-medium text-slate-900 dark:text-white mb-4">Task History</h4>
                                                <div class="space-y-4 max-h-60 overflow-y-auto pr-2">
                                                    @foreach($selectedTask->activities as $activity)
                                                        <div class="text-sm">
                                                            <p class="text-slate-700 dark:text-slate-300">{{ $activity->description }}</p>
                                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
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
                        <div class="bg-slate-50 dark:bg-slate-900/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button wire:click="closeTaskModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-900 dark:text-white shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 sm:mt-0 sm:w-auto transition-colors">
                                Close
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
