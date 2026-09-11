<div class="space-y-6">
    <!-- Pipeline Header & Actions -->
    <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 shadow-sm backdrop-blur-sm">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="h-3 w-3 rounded-full bg-{{ $workflow->color }}-500 shadow-sm shadow-{{ $workflow->color }}-500/50"></span>
                    <h2 class="text-xl font-bold tracking-tight text-white">{{ $workflow->title }}</h2>
                    <span class="rounded bg-slate-800 px-2 py-0.5 text-xs text-slate-300 font-medium">
                        {{ $workflow->department }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-1 max-w-3xl leading-relaxed">
                    {{ $workflow->description }}
                </p>
            </div>

            <!-- Header Action Controls -->
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- View Mode Switcher -->
                <div class="flex items-center rounded-lg border border-slate-800 bg-slate-900 p-0.5 text-xs">
                    <button wire:click="setViewMode('kanban')"
                            class="flex items-center gap-1.5 rounded-md px-3 py-1.5 transition-colors {{ $viewMode === 'kanban' ? 'bg-emerald-600 text-white font-semibold shadow' : 'text-slate-400 hover:text-white' }}">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                        Kanban Board
                    </button>
                    <button wire:click="setViewMode('list')"
                            class="flex items-center gap-1.5 rounded-md px-3 py-1.5 transition-colors {{ $viewMode === 'list' ? 'bg-emerald-600 text-white font-semibold shadow' : 'text-slate-400 hover:text-white' }}">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        List View
                    </button>
                </div>

                <!-- Create Task Button -->
                <button wire:click="openCreateTaskModal"
                        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3.5 py-2 text-xs font-semibold text-white shadow hover:bg-emerald-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Task
                </button>
            </div>
        </div>

        <!-- Progress Bar & Quick Pipeline Meta -->
        <div class="mt-4 pt-3 border-t border-slate-800/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-4 text-slate-400">
                <span>Owner: <strong class="text-slate-200">{{ $workflow->owner ? $workflow->owner->name : 'Unassigned' }}</strong></span>
                <span>Total: <strong class="text-slate-200">{{ $workflow->tasks->count() }} tasks</strong></span>
                @if($workflow->blocked_tasks_count > 0)
                    <span class="text-rose-400 font-semibold">{{ $workflow->blocked_tasks_count }} blocked</span>
                @endif
                @if($workflow->overdue_tasks_count > 0)
                    <span class="text-amber-400 font-semibold">{{ $workflow->overdue_tasks_count }} overdue</span>
                @endif
            </div>

            <div class="flex items-center gap-2.5 w-full sm:w-64">
                <span class="text-[11px] text-slate-400">Velocity:</span>
                <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-full rounded-full" style="width: {{ $workflow->progress_percentage }}%"></div>
                </div>
                <span class="font-mono font-semibold text-slate-200">{{ $workflow->progress_percentage }}%</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 bg-slate-950/60 p-3 rounded-xl border border-slate-800">
        <div class="relative flex-1">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search tasks by #ID, title, description..."
                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 pl-9 text-xs text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
            <svg class="absolute left-3 top-2.5 h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <select wire:model.live="priorityFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="all">All Priorities</option>
                <option value="critical">Critical</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>

            <select wire:model.live="assigneeFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="all">All Assignees</option>
                <option value="unassigned">Unassigned</option>
                @foreach($assignees as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="statusFilter"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-2.5 py-2 text-xs text-slate-200 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                <option value="all">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="active">Active</option>
                <option value="blocked">Blocked</option>
                <option value="overdue">Overdue Only</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>

    <!-- VIEW 1: KANBAN BOARD -->
    @if($viewMode === 'kanban')
        <div class="flex gap-4 overflow-x-auto pb-6 items-start">
            @foreach($stages as $stage)
                @php
                    $tasksInStage = $stageTasks[$stage->id] ?? collect();
                @endphp
                <div class="w-80 flex-shrink-0 rounded-xl border border-slate-800 bg-slate-950/70 p-3.5 space-y-3">
                    <!-- Column Header -->
                    <div class="flex items-center justify-between pb-2 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-{{ $stage->color }}-500"></span>
                            <h3 class="text-xs font-bold text-white uppercase tracking-wider">{{ $stage->name }}</h3>
                            <span class="rounded bg-slate-800 px-1.5 py-0.5 text-[10px] font-mono text-slate-400">
                                {{ $tasksInStage->count() }}
                            </span>
                        </div>

                        <button wire:click="openCreateTaskModal({{ $stage->id }})" class="text-slate-400 hover:text-white transition-colors" title="Add task to this stage">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>

                    <!-- Task Cards in this Stage -->
                    <div class="space-y-2.5 min-h-[120px]">
                        @forelse($tasksInStage as $task)
                            <div class="rounded-lg border border-slate-800 bg-slate-900/90 p-3 shadow-sm hover:border-emerald-500/60 hover:shadow-md transition-all group">
                                <div class="flex items-center justify-between text-[10px] mb-1.5">
                                    <span class="font-mono font-semibold text-slate-400">{{ $task->task_number }}</span>
                                    <div class="flex items-center gap-1.5">
                                        @if($task->isBlocked())
                                            <span class="rounded bg-rose-500/20 px-1.5 py-0.5 text-rose-300 border border-rose-500/30 font-semibold uppercase">
                                                Blocked
                                            </span>
                                        @endif
                                        @if($task->isOverdue())
                                            <span class="rounded bg-amber-500/20 px-1.5 py-0.5 text-amber-300 border border-amber-500/30 font-semibold uppercase">
                                                Overdue
                                            </span>
                                        @endif
                                        <span class="rounded px-1.5 py-0.5 font-semibold uppercase
                                            {{ $task->priority === 'critical' ? 'bg-rose-500/20 text-rose-300' : ($task->priority === 'high' ? 'bg-amber-500/20 text-amber-300' : 'bg-blue-500/20 text-blue-300') }}">
                                            {{ $task->priority }}
                                        </span>
                                    </div>
                                </div>

                                <h4 wire:click="openTaskModal({{ $task->id }})" class="text-xs font-semibold text-slate-100 hover:text-emerald-300 cursor-pointer line-clamp-2 leading-snug">
                                    {{ $task->title }}
                                </h4>

                                @if($task->description)
                                    <p class="text-[11px] text-slate-400 mt-1 line-clamp-2">{{ $task->description }}</p>
                                @endif

                                @if($task->isBlocked() && $task->blocked_reason)
                                    <div class="mt-2 rounded bg-rose-950/40 border border-rose-900/40 p-1.5 text-[10px] text-rose-300">
                                        <strong>Blocker:</strong> {{ $task->blocked_reason }}
                                    </div>
                                @endif

                                <!-- Card Footer: Assignee & Stage Advancement -->
                                <div class="mt-3 pt-2 border-t border-slate-800/80 flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-1.5">
                                        @if($task->assignee)
                                            <img class="h-5 w-5 rounded-full object-cover" src="{{ $task->assignee->avatar }}" alt="" title="{{ $task->assignee->name }}">
                                            <span class="text-[11px] text-slate-400 truncate max-w-[80px]">{{ $task->assignee->name }}</span>
                                        @else
                                            <span class="text-[10px] text-slate-500 italic">Unassigned</span>
                                        @endif
                                    </div>

                                    <!-- Stage advance dropdown -->
                                    <select wire:change="moveTaskToStage({{ $task->id }}, $event.target.value)"
                                            class="rounded bg-slate-950 border border-slate-700 px-1.5 py-0.5 text-[10px] text-slate-300 focus:outline-none focus:border-emerald-500">
                                        <option value="" disabled selected>Move Stage &darr;</option>
                                        @foreach($stages as $targetStage)
                                            @if($targetStage->id !== $stage->id)
                                                <option value="{{ $targetStage->id }}">{{ $targetStage->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-lg border border-dashed border-slate-800/80 p-4 text-center text-xs text-slate-500">
                                No tasks in this stage
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- VIEW 2: STRUCTURED TABLE / LIST -->
    @if($viewMode === 'list')
        <div class="rounded-xl border border-slate-800 bg-slate-950/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="bg-slate-900 text-[11px] font-semibold uppercase text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="px-4 py-3">Task ID</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Stage</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Priority</th>
                            <th class="px-4 py-3">Assignee</th>
                            <th class="px-4 py-3">Deadline</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80">
                        @forelse($allTasks as $task)
                            <tr class="hover:bg-slate-900/50 transition-colors">
                                <td class="px-4 py-3 font-mono font-semibold text-emerald-400">
                                    {{ $task->task_number }}
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-100 max-w-sm">
                                    <button wire:click="openTaskModal({{ $task->id }})" class="hover:text-emerald-400 transition-colors text-left">
                                        {{ $task->title }}
                                    </button>
                                    @if($task->isBlocked())
                                        <p class="text-[11px] text-rose-300 mt-0.5 truncate">{{ $task->blocked_reason }}</p>
                                    @endif
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
                                            <span>{{ $task->assignee->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-slate-500 italic">Unassigned</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 {{ $task->isOverdue() ? 'text-amber-400 font-semibold' : 'text-slate-400' }}">
                                    {{ $task->deadline ? $task->deadline->format('M d, Y') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button wire:click="openTaskModal({{ $task->id }})"
                                            class="rounded bg-slate-800 hover:bg-slate-700 text-slate-300 px-2 py-1 text-[11px] font-medium transition-colors">
                                        Inspect
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-500">
                                    No tasks matching the selected filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- CREATE TASK MODAL -->
    @if($showCreateTaskModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
             wire:keydown.escape="closeCreateTaskModal">
            <div class="w-full max-w-lg rounded-xl border border-slate-800 bg-slate-900 p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                    <h3 class="text-base font-bold text-white">Create Enterprise Task</h3>
                    <button wire:click="closeCreateTaskModal" class="text-slate-400 hover:text-white">&times;</button>
                </div>

                <form wire:submit="createTask" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300">Task Title</label>
                        <input type="text" wire:model="newTaskTitle" placeholder="e.g. Autonomous Blocker Triaging Logic"
                               class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        @error('newTaskTitle') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Initial Stage</label>
                            <select wire:model="newTaskStageId"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                @foreach($stages as $stg)
                                    <option value="{{ $stg->id }}">{{ $stg->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Priority Level</label>
                            <select wire:model="newTaskPriority"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Assignee</label>
                            <select wire:model="newTaskAssigneeId"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                <option value="">Unassigned</option>
                                @foreach($assignees as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Target Deadline</label>
                            <input type="date" wire:model="newTaskDeadline"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Est. Hours</label>
                            <input type="number" step="0.5" wire:model="newTaskEstimatedHours" placeholder="e.g. 16.0"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Tags (comma separated)</label>
                            <input type="text" wire:model="newTaskTagsInput" placeholder="AI, Autonomous, Backend"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-300">Task Scope & Description</label>
                        <textarea wire:model="newTaskDescription" rows="3" placeholder="Provide actionable instructions, operational constraints, and completion criteria..."
                                  class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                        <button type="button" wire:click="closeCreateTaskModal"
                                class="rounded-lg bg-slate-800 px-3.5 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-700 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-500 transition-colors shadow shadow-emerald-600/20">
                            Create & Commit Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- TASK DETAIL & EDIT MODAL (WITH AUDIT TRAIL) -->
    @if($showTaskModal && $selectedTask)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
             wire:keydown.escape="closeTaskModal">
            <div class="w-full max-w-2xl rounded-xl border border-slate-800 bg-slate-900 p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-xs font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 rounded px-2 py-0.5">
                            {{ $selectedTask->task_number }}
                        </span>
                        <h3 class="text-base font-bold text-white">Task Details & Audit History</h3>
                    </div>
                    <button wire:click="closeTaskModal" class="text-slate-400 hover:text-white">&times;</button>
                </div>

                <form wire:submit="updateTask" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300">Task Title</label>
                        <input type="text" wire:model="editTitle"
                               class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Stage</label>
                            <select wire:model="editStageId"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                @foreach($stages as $stg)
                                    <option value="{{ $stg->id }}">{{ $stg->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Status</label>
                            <select wire:model="editStatus"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="blocked">Blocked</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Priority</label>
                            <select wire:model="editPriority"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Assignee</label>
                            <select wire:model="editAssigneeId"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                <option value="">Unassigned</option>
                                @foreach($assignees as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Target Deadline</label>
                            <input type="date" wire:model="editDeadline"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>

                    @if($editStatus === 'blocked')
                        <div class="rounded-lg bg-rose-950/30 border border-rose-500/30 p-3">
                            <label class="block text-xs font-semibold text-rose-300">Operational Block Reason (Required)</label>
                            <textarea wire:model="editBlockedReason" rows="2" placeholder="Specify dependencies, regulatory holds, or external blocker details..."
                                      class="mt-1 block w-full rounded-lg border border-rose-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-rose-500 focus:outline-none focus:ring-1 focus:ring-rose-500"></textarea>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Est. Hours</label>
                            <input type="number" step="0.5" wire:model="editEstimatedHours"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Actual Hours Logged</label>
                            <input type="number" step="0.5" wire:model="editActualHours"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-300">Task Scope & Description</label>
                        <textarea wire:model="editDescription" rows="3"
                                  class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-2 border-t border-slate-800">
                        <button type="button" wire:click="closeTaskModal"
                                class="rounded-lg bg-slate-800 px-3.5 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-700 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-500 transition-colors shadow shadow-emerald-600/20">
                            Save Changes
                        </button>
                    </div>
                </form>

                <!-- Immutable Audit History -->
                <div class="pt-4 border-t border-slate-800 space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-bold text-white uppercase tracking-wider">Chronological Audit History</h4>
                        <span class="text-[10px] text-slate-400 font-mono">{{ $selectedTask->activities->count() }} records</span>
                    </div>

                    <!-- Add Note Input -->
                    <div class="flex gap-2">
                        <input type="text" wire:model="newAuditNote" placeholder="Add an operational audit note..."
                               class="flex-1 rounded-lg border border-slate-700 bg-slate-950 px-3 py-1.5 text-xs text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        <button type="button" wire:click="addAuditNote"
                                class="rounded-lg bg-slate-800 hover:bg-emerald-600 text-slate-200 px-3 py-1.5 text-xs font-semibold transition-colors">
                            Log Note
                        </button>
                    </div>

                    <div class="max-h-48 overflow-y-auto space-y-2 rounded-lg border border-slate-800 bg-slate-950/70 p-3 divide-y divide-slate-800/60">
                        @foreach($selectedTask->activities as $act)
                            <div class="pt-2 first:pt-0 text-xs">
                                <div class="flex items-center justify-between text-slate-400">
                                    <span class="font-medium text-slate-200">{{ $act->user ? $act->user->name : 'System' }}</span>
                                    <span class="text-[10px] font-mono text-slate-500">{{ $act->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <p class="text-slate-300 mt-0.5">{{ $act->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- BLOCK TASK CONFIRMATION MODAL -->
    @if($showBlockModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
             wire:keydown.escape="closeBlockModal">
            <div class="w-full max-w-md rounded-xl border border-rose-500/30 bg-slate-900 p-6 shadow-2xl space-y-4">
                <div class="flex items-center gap-2.5 text-rose-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <h3 class="text-base font-bold text-white">Flag Task as Blocked</h3>
                </div>

                <p class="text-xs text-slate-300 leading-relaxed">
                    Enterprise governance requires documentation of why this task cannot proceed. This blocker reason will be broadcast to the Operations Dashboard triage queue.
                </p>

                <div>
                    <label class="block text-xs font-semibold text-rose-300 mb-1">Blocker Description / Root Cause</label>
                    <textarea wire:model="blockReason" rows="3" placeholder="e.g. Awaiting hardware allocation / Third party security review..."
                              class="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 placeholder-slate-500 focus:border-rose-500 focus:outline-none focus:ring-1 focus:ring-rose-500"></textarea>
                    @error('blockReason') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-slate-800">
                    <button type="button" wire:click="closeBlockModal"
                            class="rounded-lg bg-slate-800 px-3.5 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-700 transition-colors">
                        Cancel
                    </button>
                    <button type="button" wire:click="confirmBlockTask"
                            class="rounded-lg bg-rose-600 hover:bg-rose-500 px-4 py-2 text-xs font-semibold text-white transition-colors shadow">
                        Confirm Block
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
