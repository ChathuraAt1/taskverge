<div class="space-y-6">
    <!-- Top Operations Filter Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800 pb-5">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-xl font-bold tracking-tight text-white">Enterprise Workflow Intelligence</h2>
                <span class="inline-flex items-center rounded-full bg-indigo-500/10 px-2.5 py-0.5 text-xs font-semibold text-indigo-400 border border-indigo-500/20">
                    Live Telemetry
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-0.5">Real-time status tracking, bottleneck detection, and workflow velocity monitoring</p>
        </div>

        <div class="flex items-center gap-2">
            <span class="text-xs text-slate-400 font-medium">Department:</span>
            <select wire:model.live="selectedDepartment"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-3 py-1.5 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="all">All Enterprise Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Executive KPI Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-3 sm:gap-4">
        <!-- Total Tasks -->
        <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-4 shadow-sm backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-400">Total Workflows</span>
                <div class="p-1.5 rounded-md bg-slate-800 text-slate-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            <div class="mt-2 text-2xl font-bold text-white">{{ $totalTasks }}</div>
            <div class="text-[11px] text-slate-400 mt-1">across {{ $workflows->count() }} active pipelines</div>
        </div>

        <!-- Active Tasks -->
        <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-4 shadow-sm backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-400">Active Tasks</span>
                <div class="p-1.5 rounded-md bg-blue-500/10 text-blue-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="mt-2 text-2xl font-bold text-blue-400">{{ $activeTasks }}</div>
            <div class="text-[11px] text-slate-400 mt-1">in flight & processing</div>
        </div>

        <!-- Blocked Tasks (Crucial bottleneck indicator) -->
        <div class="rounded-xl border border-rose-500/30 bg-rose-950/20 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-rose-400">Blocked Work</span>
                <div class="p-1.5 rounded-md bg-rose-500/20 text-rose-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
            <div class="mt-2 text-2xl font-bold text-rose-300">{{ $blockedTasks }}</div>
            <div class="text-[11px] text-rose-400/80 mt-1 font-medium">Requires triage action</div>
        </div>

        <!-- Overdue Tasks -->
        <div class="rounded-xl border border-amber-500/30 bg-amber-950/20 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-amber-400">Overdue Tasks</span>
                <div class="p-1.5 rounded-md bg-amber-500/20 text-amber-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="mt-2 text-2xl font-bold text-amber-300">{{ $overdueTasks }}</div>
            <div class="text-[11px] text-amber-400/80 mt-1 font-medium">Passed SLA / target date</div>
        </div>

        <!-- Completed Tasks -->
        <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-4 shadow-sm backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-400">Completed</span>
                <div class="p-1.5 rounded-md bg-emerald-500/10 text-emerald-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="mt-2 text-2xl font-bold text-emerald-400">{{ $completedTasks }}</div>
            <div class="text-[11px] text-slate-400 mt-1">verified & finalized</div>
        </div>

        <!-- Success Velocity % -->
        <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-4 shadow-sm backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-slate-400">Overall Progress</span>
                <div class="p-1.5 rounded-md bg-indigo-500/10 text-indigo-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div class="mt-2 text-2xl font-bold text-indigo-300">{{ $completionRate }}%</div>
            <div class="w-full bg-slate-800 h-1.5 rounded-full mt-2 overflow-hidden">
                <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $completionRate }}%"></div>
            </div>
        </div>
    </div>

    <!-- Urgent Attention Queue & Bottleneck Triage -->
    <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
            <div class="flex items-center gap-2">
                <span class="flex h-2.5 w-2.5 rounded-full bg-rose-500 animate-pulse"></span>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Urgent Attention Queue (Bottlenecks & Overdue)</h3>
            </div>
            <span class="text-xs text-slate-400">Items flagged for operational supervisor review</span>
        </div>

        @if($urgentAttentionTasks->isEmpty())
            <div class="rounded-lg border border-slate-800/80 bg-slate-900/40 p-8 text-center">
                <svg class="mx-auto h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm font-medium text-slate-200 mt-2">Zero Operational Bottlenecks</p>
                <p class="text-xs text-slate-400 mt-1">All tasks within this scope are proceeding within nominal delivery timelines.</p>
            </div>
        @else
            <div class="divide-y divide-slate-800/80">
                @foreach($urgentAttentionTasks as $task)
                    <div class="py-3.5 flex flex-col md:flex-row md:items-center justify-between gap-3 group hover:bg-slate-900/40 px-2 rounded-lg transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5">
                                @if($task->isBlocked())
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                        Blocked
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                        Overdue
                                    </span>
                                @endif
                            </div>

                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-mono text-slate-400 font-semibold">{{ $task->task_number }}</span>
                                    <button wire:click="inspectTask({{ $task->id }})" class="text-sm font-semibold text-slate-100 hover:text-indigo-400 transition-colors text-left">
                                        {{ $task->title }}
                                    </button>
                                </div>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1 text-xs text-slate-400">
                                    <span>Pipeline: <strong class="text-slate-300">{{ $task->workflow->title }}</strong></span>
                                    <span>Stage: <strong class="text-slate-300">{{ $task->stage->name }}</strong></span>
                                    @if($task->deadline)
                                        <span class="{{ $task->isOverdue() ? 'text-amber-400 font-medium' : 'text-slate-400' }}">
                                            Target: {{ $task->deadline->format('M d, Y') }} ({{ $task->deadline->diffForHumans() }})
                                        </span>
                                    @endif
                                </div>
                                @if($task->isBlocked() && $task->blocked_reason)
                                    <p class="mt-1.5 text-xs text-rose-300/90 bg-rose-950/30 border border-rose-900/40 rounded px-2.5 py-1">
                                        <strong class="font-semibold">Block Reason:</strong> {{ $task->blocked_reason }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- 1-Click Triage Actions -->
                        <div class="flex items-center gap-2 self-end md:self-center">
                            @if($task->isBlocked())
                                <button wire:click="unblockTask({{ $task->id }})"
                                        class="inline-flex items-center gap-1 rounded-md bg-emerald-600/20 hover:bg-emerald-600 text-emerald-300 hover:text-white px-2.5 py-1 text-xs font-medium border border-emerald-500/30 transition-colors">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Unblock
                                </button>
                            @endif

                            <button wire:click="completeTask({{ $task->id }})"
                                    class="inline-flex items-center gap-1 rounded-md bg-slate-800 hover:bg-indigo-600 text-slate-300 hover:text-white px-2.5 py-1 text-xs font-medium border border-slate-700 transition-colors">
                                Complete
                            </button>

                            <button wire:click="inspectTask({{ $task->id }})"
                                    class="rounded-md bg-slate-800 hover:bg-slate-700 text-slate-300 px-2.5 py-1 text-xs font-medium border border-slate-700 transition-colors">
                                Details & Logs
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Two Columns: Workflows Progress Matrix & Real-Time Activity Feed -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Workflow Progress Matrix (2 Columns) -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Workflow Intelligence Status Matrix</h3>
                <a href="{{ route('workflows.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300 font-medium">
                    View All Pipelines &rarr;
                </a>
            </div>

            <div class="space-y-3">
                @foreach($workflows as $wf)
                    <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-4 hover:border-slate-700 transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="h-2.5 w-2.5 rounded-full bg-{{ $wf->color }}-500"></span>
                                    <a href="{{ route('workflows.show', $wf) }}" class="text-sm font-bold text-white hover:text-indigo-400 transition-colors">
                                        {{ $wf->title }}
                                    </a>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $wf->description }}</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="text-xs font-mono font-semibold text-slate-200">
                                    {{ $wf->progress_percentage }}%
                                </span>
                                <a href="{{ route('workflows.show', $wf) }}"
                                   class="rounded-lg bg-slate-900 border border-slate-700 px-2.5 py-1 text-xs font-medium text-slate-200 hover:bg-indigo-600 hover:text-white transition-colors">
                                    Open Workspace
                                </a>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-slate-800 h-2 rounded-full mt-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-500 to-emerald-400 h-full rounded-full" style="width: {{ $wf->progress_percentage }}%"></div>
                        </div>

                        <!-- Quick Stages Footprint -->
                        <div class="mt-3 flex flex-wrap items-center gap-2 pt-2 border-t border-slate-900 text-xs">
                            <span class="text-[11px] text-slate-500">Stages:</span>
                            @foreach($wf->stages as $stg)
                                <span class="rounded bg-slate-900 px-2 py-0.5 text-[11px] text-slate-300 border border-slate-800">
                                    {{ $stg->name }} ({{ $stg->tasks->count() }})
                                </span>
                            @endforeach
                            <div class="ml-auto flex items-center gap-2 text-[11px] text-slate-400">
                                @if($wf->blocked_tasks_count > 0)
                                    <span class="text-rose-400 font-semibold">{{ $wf->blocked_tasks_count }} blocked</span>
                                @endif
                                @if($wf->overdue_tasks_count > 0)
                                    <span class="text-amber-400 font-semibold">{{ $wf->overdue_tasks_count }} overdue</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Priority Distribution Overview -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-4">
                <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3">Enterprise Priority Distribution</h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="rounded-lg bg-rose-950/20 border border-rose-500/20 p-2.5 text-center">
                        <span class="text-[11px] font-bold uppercase text-rose-400">Critical</span>
                        <p class="text-xl font-bold text-rose-300 mt-0.5">{{ $criticalTasks }}</p>
                    </div>
                    <div class="rounded-lg bg-amber-950/20 border border-amber-500/20 p-2.5 text-center">
                        <span class="text-[11px] font-bold uppercase text-amber-400">High</span>
                        <p class="text-xl font-bold text-amber-300 mt-0.5">{{ $highTasks }}</p>
                    </div>
                    <div class="rounded-lg bg-blue-950/20 border border-blue-500/20 p-2.5 text-center">
                        <span class="text-[11px] font-bold uppercase text-blue-400">Medium</span>
                        <p class="text-xl font-bold text-blue-300 mt-0.5">{{ $mediumTasks }}</p>
                    </div>
                    <div class="rounded-lg bg-slate-900 border border-slate-800 p-2.5 text-center">
                        <span class="text-[11px] font-bold uppercase text-slate-400">Low</span>
                        <p class="text-xl font-bold text-slate-300 mt-0.5">{{ $lowTasks }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Real-Time Audit Activity Feed (1 Column) -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Immutable Audit Trail</h3>
                <span class="text-[10px] rounded bg-slate-800 px-2 py-0.5 text-slate-400 font-mono">SOC2 Compliant</span>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-4 divide-y divide-slate-800/80">
                @foreach($recentActivities as $act)
                    <div class="py-2.5 first:pt-0 last:pb-0">
                        <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1">
                            <span class="font-medium text-slate-300">{{ $act->user ? $act->user->name : 'System' }}</span>
                            <span class="font-mono text-slate-500">{{ $act->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-slate-200">
                            {{ $act->description }}
                        </p>
                        <div class="mt-1 flex items-center gap-2">
                            <span class="text-[10px] font-mono text-indigo-400 bg-indigo-950/50 border border-indigo-900/40 rounded px-1.5 py-0.2">
                                {{ $act->task->task_number }}
                            </span>
                            <span class="text-[11px] text-slate-400 truncate">
                                {{ $act->task->workflow->title }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Technology Callout Card -->
            <div class="rounded-xl border border-indigo-500/20 bg-gradient-to-br from-indigo-950/40 to-slate-950 p-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">NVIDIA Workflow Engine</h4>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Connected to Triton Inference Server & Nemotron reasoning endpoints for automated bottleneck detection, task dependency resolution, and SLA forecasting.
                </p>
                <div class="mt-3 pt-3 border-t border-indigo-900/40 flex items-center justify-between text-[11px] text-indigo-300">
                    <span>Inference latency: <strong>4.2ms</strong></span>
                    <span>State: <strong>Synchronized</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Detail Modal -->
    @if($showTaskModal && $selectedTask)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
             wire:keydown.escape="closeTaskModal">
            <div class="w-full max-w-2xl rounded-xl border border-slate-800 bg-slate-900 p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
                <div class="flex items-start justify-between border-b border-slate-800 pb-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-xs font-bold text-indigo-400 bg-indigo-950/60 border border-indigo-800/60 rounded px-2 py-0.5">
                                {{ $selectedTask->task_number }}
                            </span>
                            <span class="text-xs uppercase font-semibold px-2 py-0.5 rounded
                                {{ $selectedTask->priority === 'critical' ? 'bg-rose-500/20 text-rose-300' : ($selectedTask->priority === 'high' ? 'bg-amber-500/20 text-amber-300' : 'bg-blue-500/20 text-blue-300') }}">
                                {{ $selectedTask->priority }}
                            </span>
                            <span class="text-xs uppercase font-semibold px-2 py-0.5 rounded
                                {{ $selectedTask->status === 'blocked' ? 'bg-rose-500/20 text-rose-300' : ($selectedTask->status === 'completed' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-blue-500/20 text-blue-300') }}">
                                {{ $selectedTask->status }}
                            </span>
                        </div>
                        <h3 class="text-base font-bold text-white mt-1">{{ $selectedTask->title }}</h3>
                        <p class="text-xs text-slate-400">Pipeline: {{ $selectedTask->workflow->title }} &bull; Stage: {{ $selectedTask->stage->name }}</p>
                    </div>
                    <button wire:click="closeTaskModal" class="text-slate-400 hover:text-white">&times;</button>
                </div>

                <!-- Description -->
                <div>
                    <h4 class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Description</h4>
                    <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950/60 border border-slate-800 rounded-lg p-3">
                        {{ $selectedTask->description ?? 'No detailed description specified.' }}
                    </p>
                </div>

                <!-- Block reason if present -->
                @if($selectedTask->isBlocked())
                    <div class="rounded-lg bg-rose-950/30 border border-rose-500/30 p-3">
                        <span class="text-xs font-semibold text-rose-400 uppercase tracking-wider">Current Block Reason</span>
                        <p class="text-xs text-rose-300 mt-1">{{ $selectedTask->blocked_reason }}</p>
                    </div>
                @endif

                <!-- Metadata Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-950/40 p-3 rounded-lg border border-slate-800 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase">Assignee</span>
                        <span class="font-medium text-slate-200">{{ $selectedTask->assignee ? $selectedTask->assignee->name : 'Unassigned' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase">Deadline</span>
                        <span class="font-medium {{ $selectedTask->isOverdue() ? 'text-amber-400' : 'text-slate-200' }}">
                            {{ $selectedTask->deadline ? $selectedTask->deadline->format('M d, Y') : 'None' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase">Est. Hours</span>
                        <span class="font-medium text-slate-200">{{ $selectedTask->estimated_hours ?? '-' }} hrs</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px] uppercase">Actual Hours</span>
                        <span class="font-medium text-slate-200">{{ $selectedTask->actual_hours }} hrs</span>
                    </div>
                </div>

                <!-- Audit Log History -->
                <div>
                    <h4 class="text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Audit History</h4>
                    <div class="max-h-40 overflow-y-auto space-y-2 rounded-lg border border-slate-800 bg-slate-950/60 p-3 divide-y divide-slate-800/60">
                        @foreach($selectedTask->activities as $activity)
                            <div class="pt-1.5 first:pt-0 text-xs">
                                <div class="flex items-center justify-between text-slate-400">
                                    <span class="font-medium text-slate-300">{{ $activity->user ? $activity->user->name : 'System' }}</span>
                                    <span class="text-[10px] font-mono">{{ $activity->created_at->format('M d, H:i') }}</span>
                                </div>
                                <p class="text-slate-300 mt-0.5">{{ $activity->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-slate-800">
                    <a href="{{ route('workflows.show', $selectedTask->workflow) }}"
                       class="rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white hover:bg-indigo-500 transition-colors">
                        Go to Workflow Board
                    </a>
                    <button wire:click="closeTaskModal"
                            class="rounded-lg bg-slate-800 px-4 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-700 transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
