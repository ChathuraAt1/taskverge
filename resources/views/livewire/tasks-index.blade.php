<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800 pb-5">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-white">Master Task Registry</h2>
            <p class="text-xs text-slate-400 mt-0.5">Centralized inventory of all enterprise tasks, assignments, and deadlines</p>
        </div>

        <div class="flex items-center gap-2">
            <span class="rounded-lg border border-slate-800 bg-slate-950 px-3 py-1.5 text-xs text-slate-400 font-mono">
                Total: {{ $tasks->total() }} tasks
            </span>
        </div>
    </div>

    <!-- Multi-parameter Filtering Bar -->
    <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 bg-slate-950/60 p-3 rounded-xl border border-slate-800">
        <div class="relative flex-1">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search across all tasks..."
                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 pl-9 text-xs text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            <svg class="absolute left-3 top-2.5 h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <select wire:model.live="workflowFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 max-w-[180px]">
                <option value="all">All Workflows</option>
                @foreach($workflows as $wf)
                    <option value="{{ $wf->id }}">{{ $wf->title }}</option>
                @endforeach
            </select>

            <select wire:model.live="priorityFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="all">All Priorities</option>
                <option value="critical">Critical</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>

            <select wire:model.live="statusFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="all">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="blocked">Blocked</option>
                <option value="overdue">Overdue Only</option>
                <option value="completed">Completed</option>
            </select>

            <select wire:model.live="assigneeFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="all">All Assignees</option>
                <option value="unassigned">Unassigned</option>
                @foreach($assignees as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Tasks Master Table -->
    <div class="rounded-xl border border-slate-800 bg-slate-950/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-900 text-[11px] font-semibold uppercase text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-4 py-3">Task ID</th>
                        <th class="px-4 py-3">Title & Summary</th>
                        <th class="px-4 py-3">Workflow Pipeline</th>
                        <th class="px-4 py-3">Stage</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Priority</th>
                        <th class="px-4 py-3">Assignee</th>
                        <th class="px-4 py-3">Deadline</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-slate-900/50 transition-colors">
                            <td class="px-4 py-3 font-mono font-semibold text-indigo-400">
                                {{ $task->task_number }}
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <button wire:click="inspectTask({{ $task->id }})" class="font-medium text-slate-100 hover:text-indigo-400 transition-colors text-left line-clamp-1">
                                    {{ $task->title }}
                                </button>
                                @if($task->isBlocked() && $task->blocked_reason)
                                    <p class="text-[11px] text-rose-300 mt-0.5 truncate">{{ $task->blocked_reason }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('workflows.show', $task->workflow) }}" class="text-slate-300 hover:text-indigo-300 transition-colors truncate block max-w-[150px]">
                                    {{ $task->workflow->title }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <span class="rounded bg-slate-900 border border-slate-800 px-2 py-0.5 text-[11px] text-slate-300">
                                    {{ $task->stage->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="rounded px-2 py-0.5 text-[10px] font-semibold uppercase
                                    {{ $task->status === 'blocked' ? 'bg-rose-500/20 text-rose-300' : ($task->status === 'completed' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-blue-500/20 text-blue-300') }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="rounded px-2 py-0.5 text-[10px] font-semibold uppercase
                                    {{ $task->priority === 'critical' ? 'bg-rose-500/20 text-rose-300' : ($task->priority === 'high' ? 'bg-amber-500/20 text-amber-300' : 'bg-blue-500/20 text-blue-300') }}">
                                    {{ $task->priority }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($task->assignee)
                                    <div class="flex items-center gap-1.5">
                                        <img class="h-5 w-5 rounded-full object-cover" src="{{ $task->assignee->avatar }}" alt="">
                                        <span class="truncate max-w-[100px]">{{ $task->assignee->name }}</span>
                                    </div>
                                @else
                                    <span class="text-slate-500 italic">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 {{ $task->isOverdue() ? 'text-amber-400 font-semibold' : 'text-slate-400' }}">
                                {{ $task->deadline ? $task->deadline->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button wire:click="inspectTask({{ $task->id }})"
                                        class="rounded bg-slate-800 hover:bg-slate-700 text-slate-300 px-2.5 py-1 text-[11px] font-medium transition-colors">
                                    Details
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-8 text-center text-slate-500">
                                No tasks found matching current filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tasks->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $tasks->links() }}
            </div>
        @endif
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
                        </div>
                        <h3 class="text-base font-bold text-white mt-1">{{ $selectedTask->title }}</h3>
                        <p class="text-xs text-slate-400">Pipeline: {{ $selectedTask->workflow->title }} &bull; Stage: {{ $selectedTask->stage->name }}</p>
                    </div>
                    <button wire:click="closeTaskModal" class="text-slate-400 hover:text-white">&times;</button>
                </div>

                <div>
                    <h4 class="text-xs font-semibold text-slate-300 uppercase tracking-wider">Description</h4>
                    <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950/60 border border-slate-800 rounded-lg p-3">
                        {{ $selectedTask->description ?? 'No description.' }}
                    </p>
                </div>

                @if($selectedTask->isBlocked())
                    <div class="rounded-lg bg-rose-950/30 border border-rose-500/30 p-3">
                        <span class="text-xs font-semibold text-rose-400 uppercase tracking-wider">Block Reason</span>
                        <p class="text-xs text-rose-300 mt-1">{{ $selectedTask->blocked_reason }}</p>
                    </div>
                @endif

                <!-- Audit Log History -->
                <div>
                    <h4 class="text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Audit History</h4>
                    <div class="max-h-48 overflow-y-auto space-y-2 rounded-lg border border-slate-800 bg-slate-950/60 p-3 divide-y divide-slate-800/60">
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
                        Open In Workspace Board
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
