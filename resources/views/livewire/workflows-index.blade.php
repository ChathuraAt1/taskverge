<div class="space-y-6">
    <!-- Header & Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800 pb-5">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-white">Workflows & Project Pipelines</h2>
            <p class="text-xs text-slate-400 mt-0.5">Define, configure, and monitor multi-stage operational lifecycles</p>
        </div>

        @if(auth()->user()->canManageWorkflows())
            <button wire:click="openCreateModal"
                    class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-3.5 py-2 text-xs font-semibold text-white shadow hover:bg-indigo-500 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Workflow Pipeline
            </button>
        @endif
    </div>

    <!-- Filter & Search Bar -->
    <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 bg-slate-950/60 p-3 rounded-xl border border-slate-800">
        <div class="relative flex-1">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search workflows by title or description..."
                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 pl-9 text-xs text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            <svg class="absolute left-3 top-2.5 h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <div class="flex items-center gap-2">
            <select wire:model.live="selectedDepartment"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="all">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>

            <select wire:model.live="selectedStatus"
                    class="rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs text-slate-200 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                <option value="all">All Statuses</option>
                <option value="active">Active Only</option>
                <option value="paused">Paused</option>
                <option value="archived">Archived</option>
            </select>
        </div>
    </div>

    <!-- Workflows Grid -->
    @if($workflows->isEmpty())
        <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-12 text-center">
            <svg class="mx-auto h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            <h3 class="mt-3 text-sm font-semibold text-slate-200">No workflow pipelines found</h3>
            <p class="text-xs text-slate-400 mt-1">Try adjusting your department filter or create a new pipeline.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($workflows as $workflow)
                <div class="flex flex-col justify-between rounded-xl border border-slate-800 bg-slate-950/80 p-5 shadow-sm hover:border-slate-700 hover:shadow-md transition-all group">
                    <div>
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-2">
                                <span class="h-3 w-3 rounded-full bg-{{ $workflow->color }}-500 shadow-sm shadow-{{ $workflow->color }}-500/50"></span>
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">{{ $workflow->department }}</span>
                            </div>

                            <button wire:click="toggleStarred({{ $workflow->id }})" class="text-slate-500 hover:text-amber-400 transition-colors">
                                <svg class="h-4 w-4 {{ $workflow->is_starred ? 'text-amber-400 fill-amber-400' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </button>
                        </div>

                        <h3 class="text-base font-bold text-white mt-2 group-hover:text-indigo-400 transition-colors">
                            <a href="{{ route('workflows.show', $workflow) }}">{{ $workflow->title }}</a>
                        </h3>

                        <p class="text-xs text-slate-400 mt-2 line-clamp-2 leading-relaxed">
                            {{ $workflow->description ?? 'No specific workflow description provided.' }}
                        </p>
                    </div>

                    <div class="mt-5 pt-4 border-t border-slate-900 space-y-3">
                        <!-- Progress Bar & Metrics -->
                        <div>
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span class="text-slate-400">Completion</span>
                                <span class="font-mono font-semibold text-slate-200">{{ $workflow->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $workflow->progress_percentage }}%"></div>
                            </div>
                        </div>

                        <!-- Stats Row -->
                        <div class="flex items-center justify-between text-xs text-slate-400">
                            <div class="flex items-center gap-3">
                                <span>{{ $workflow->stages->count() }} stages</span>
                                <span>{{ $workflow->tasks->count() }} tasks</span>
                            </div>

                            <div class="flex items-center gap-2">
                                @if($workflow->blocked_tasks_count > 0)
                                    <span class="rounded bg-rose-500/20 text-rose-300 border border-rose-500/30 px-1.5 py-0.5 text-[10px] font-semibold">
                                        {{ $workflow->blocked_tasks_count }} blocked
                                    </span>
                                @endif
                                @if($workflow->overdue_tasks_count > 0)
                                    <span class="rounded bg-amber-500/20 text-amber-300 border border-amber-500/30 px-1.5 py-0.5 text-[10px] font-semibold">
                                        {{ $workflow->overdue_tasks_count }} overdue
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Button & Owner -->
                        <div class="flex items-center justify-between pt-1">
                            <div class="flex items-center gap-2">
                                @if($workflow->owner)
                                    <img class="h-5 w-5 rounded-full object-cover" src="{{ $workflow->owner->avatar }}" alt="">
                                    <span class="text-[11px] text-slate-400 truncate max-w-[100px]">{{ $workflow->owner->name }}</span>
                                @endif
                            </div>

                            <a href="{{ route('workflows.show', $workflow) }}"
                               class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-400 hover:text-indigo-300">
                                Open Workspace &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Create Workflow Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
             wire:keydown.escape="closeCreateModal">
            <div class="w-full max-w-lg rounded-xl border border-slate-800 bg-slate-900 p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                    <h3 class="text-base font-bold text-white">Create New Workflow Pipeline</h3>
                    <button wire:click="closeCreateModal" class="text-slate-400 hover:text-white">&times;</button>
                </div>

                <form wire:submit="createWorkflow" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300">Pipeline Title</label>
                        <input type="text" wire:model="newTitle" placeholder="e.g. Multi-Cloud Triton Serving Architecture"
                               class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        @error('newTitle') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Department</label>
                            <input type="text" wire:model="newDepartment" placeholder="Operations, Logistics, etc."
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('newDepartment') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Accent Color</label>
                            <select wire:model="newColor"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <option value="indigo">Indigo</option>
                                <option value="emerald">Emerald</option>
                                <option value="blue">Blue</option>
                                <option value="purple">Purple</option>
                                <option value="amber">Amber</option>
                                <option value="rose">Rose</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-300">Workflow Administrator / Owner</label>
                        <select wire:model="newOwnerId"
                                class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @foreach($managers as $mgr)
                                <option value="{{ $mgr->id }}">{{ $mgr->name }} ({{ $mgr->role }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-300">Description & Mission Objectives</label>
                        <textarea wire:model="newDescription" rows="3" placeholder="Outline scope, operational dependencies, and key deliverables..."
                                  class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-xs text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="rounded-lg bg-indigo-950/30 border border-indigo-500/20 p-3 text-[11px] text-indigo-300 leading-relaxed">
                        <strong class="font-semibold">Automated Setup:</strong> 5 enterprise stages (Backlog, Active Processing, Review & QA, Blocked, and Completed) will be provisioned automatically with customizable stage workflows.
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-800">
                        <button type="button" wire:click="closeCreateModal"
                                class="rounded-lg bg-slate-800 px-3.5 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-700 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white hover:bg-indigo-500 transition-colors shadow">
                            Provision Pipeline
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
