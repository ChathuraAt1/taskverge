<div class="space-y-6">
    <!-- Top Header & Export -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="h-8 w-8 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 shadow-md">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-white tracking-tight">Compliance &amp; Activity Audit Trail</h2>
                    <p class="text-xs text-slate-400">Immutable chronological history of all workflow state changes, reassignments, and interventions</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="rounded-xl border border-slate-800 bg-slate-950 px-3 py-1.5 text-xs text-slate-400 font-mono">
                Retention: <strong class="text-white">{{ $retentionDays ? "{$retentionDays} Days" : 'Unlimited' }}</strong> ({{ $planConfig['label'] }})
            </div>

            <button 
                wire:click="exportCsv" 
                class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-3.5 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/30 transition-all"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Export CSV Audit</span>
            </button>
        </div>
    </div>

    <!-- Filters Row -->
    <div class="flex flex-wrap items-center gap-3">
        <!-- Action Filter -->
        <select wire:model.live="actionFilter" class="rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
            <option value="all">All Action Types</option>
            <option value="created">Created</option>
            <option value="stage_moved">Stage Moved</option>
            <option value="status_changed">Status Changed</option>
            <option value="blocked">Flagged Blocked</option>
            <option value="unblocked">Unblocked</option>
            <option value="assigned">Assigned / Reassigned</option>
        </select>

        <!-- User Filter -->
        <select wire:model.live="userFilter" class="rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
            <option value="all">All Team Actors</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role }})</option>
            @endforeach
        </select>

        <!-- Workflow Filter -->
        <select wire:model.live="workflowFilter" class="rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
            <option value="all">All Pipelines</option>
            @foreach($workflows as $wf)
                <option value="{{ $wf->id }}">{{ $wf->title }}</option>
            @endforeach
        </select>
    </div>

    <!-- Activity Log Table -->
    <div class="rounded-2xl border border-slate-800 bg-slate-950/80 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-900/80 text-[11px] font-bold uppercase tracking-wider text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4">Timestamp</th>
                        <th class="py-3.5 px-4">Action</th>
                        <th class="py-3.5 px-4">Task</th>
                        <th class="py-3.5 px-4">Pipeline</th>
                        <th class="py-3.5 px-4">Description</th>
                        <th class="py-3.5 px-4">Actor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($activities as $act)
                        <tr class="hover:bg-slate-900/40 transition-colors">
                            <td class="py-3 px-4 font-mono text-slate-400 whitespace-nowrap">
                                {{ $act->created_at->format('M d, Y H:i:s') }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider
                                    @if($act->action === 'blocked') bg-rose-500/10 text-rose-400 border border-rose-500/30
                                    @elseif($act->action === 'unblocked') bg-emerald-500/10 text-emerald-400 border border-emerald-500/30
                                    @elseif($act->action === 'created') bg-blue-500/10 text-blue-400 border border-blue-500/30
                                    @elseif($act->action === 'status_changed') bg-teal-500/10 text-teal-400 border border-teal-500/30
                                    @elseif($act->action === 'stage_moved') bg-purple-500/10 text-purple-400 border border-purple-500/30
                                    @else bg-slate-800 text-slate-300 border border-slate-700 @endif">
                                    {{ str_replace('_', ' ', $act->action) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-semibold text-white whitespace-nowrap">
                                @if($act->task)
                                    <span class="text-emerald-400 font-mono text-[11px]">{{ $act->task->task_number }}</span>
                                    <span class="text-slate-300 ml-1.5">{{ Str::limit($act->task->title, 28) }}</span>
                                @else
                                    <span class="text-slate-500 italic">Deleted Task</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-slate-300 whitespace-nowrap">
                                {{ $act->task?->workflow?->title ?? 'General' }}
                            </td>
                            <td class="py-3 px-4 text-slate-300">
                                {{ $act->description }}
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    @if($act->user)
                                        <img class="h-5 w-5 rounded-full object-cover" src="{{ $act->user->avatar }}" alt="">
                                        <span class="text-white font-medium">{{ $act->user->name }}</span>
                                    @else
                                        <span class="text-slate-400">System</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                No audit activity matching the selected filters within the retention window.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($activities->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</div>
