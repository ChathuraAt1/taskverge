<div class="space-y-6">
    <!-- Top Header & Member Quota -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="h-8 w-8 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 shadow-md">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-white tracking-tight">Team Capacity &amp; Workload Hub</h2>
                    <p class="text-xs text-slate-400">Manage member task allocations, surge indicators, and department balance</p>
                </div>
            </div>
        </div>

        <!-- Seat Allocation Meter -->
        <div class="flex items-center gap-3">
            <div class="rounded-xl border border-slate-800 bg-slate-950 px-4 py-2 text-xs">
                <span class="text-slate-400">Team Seats: </span>
                @if($maxUsers === null)
                    <strong class="text-emerald-400 font-bold">{{ $totalMembersCount }} active (Unlimited)</strong>
                @else
                    <strong class="text-white font-semibold">{{ $totalMembersCount }} / {{ $maxUsers }} active</strong>
                    @if($totalMembersCount >= $maxUsers)
                        <span class="ml-1 rounded bg-amber-500/20 text-amber-300 px-1.5 py-0.5 text-[10px] font-bold">Quota Reached</span>
                    @endif
                @endif
                <span class="text-slate-600 mx-1.5">•</span>
                <span class="text-slate-400">{{ $planConfig['label'] }}</span>
            </div>

            @if($maxUsers !== null && $totalMembersCount >= $maxUsers)
                <a href="{{ route('checkout') }}?plan=core" class="rounded-xl bg-emerald-600 hover:bg-emerald-500 px-3.5 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/30 transition-all">
                    Upgrade Seats
                </a>
            @endif
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Search member name, email, or title..." 
                class="w-full sm:w-72 rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none"
            >

            <select 
                wire:model.live="departmentFilter" 
                class="rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none"
            >
                <option value="all">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-3 text-xs text-slate-400 font-medium">
            <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Optimal (1-3)</span>
            <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-amber-400"></span> High (4-6)</span>
            <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-rose-400"></span> Overloaded (7+)</span>
        </div>
    </div>

    <!-- Members Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($members as $member)
            <div class="rounded-2xl border border-slate-800 bg-slate-950/80 p-5 space-y-4 hover:border-slate-700 transition-colors shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <img class="h-10 w-10 rounded-xl object-cover ring-1 ring-slate-800" src="{{ $member->avatar }}" alt="{{ $member->name }}">
                        <div>
                            <h3 class="text-sm font-bold text-white">{{ $member->name }}</h3>
                            <p class="text-[11px] text-slate-400">{{ $member->title ?? 'Team Specialist' }}</p>
                        </div>
                    </div>

                    <!-- Capacity Badge -->
                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider
                        @if($member->capacity_status === 'optimal') bg-emerald-500/10 text-emerald-400 border border-emerald-500/30
                        @elseif($member->capacity_status === 'high') bg-amber-500/10 text-amber-400 border border-amber-500/30
                        @elseif($member->capacity_status === 'overloaded') bg-rose-500/10 text-rose-400 border border-rose-500/30
                        @else bg-slate-800 text-slate-400 border border-slate-700 @endif">
                        {{ $member->capacity_label }}
                    </span>
                </div>

                <div class="text-[11px] text-slate-400 font-mono">
                    Dept: <span class="text-slate-300">{{ $member->department ?? 'General Operations' }}</span>
                </div>

                <!-- Metrics Strip -->
                <div class="grid grid-cols-3 gap-2 rounded-xl bg-slate-900/60 p-2.5 text-center text-xs">
                    <div>
                        <span class="block text-[10px] font-semibold uppercase text-slate-500">Active</span>
                        <strong class="text-sm font-bold text-white">{{ $member->active_tasks_count }}</strong>
                    </div>
                    <div>
                        <span class="block text-[10px] font-semibold uppercase text-slate-500">Blocked</span>
                        <strong class="text-sm font-bold {{ $member->blocked_tasks_count > 0 ? 'text-rose-400' : 'text-slate-400' }}">{{ $member->blocked_tasks_count }}</strong>
                    </div>
                    <div>
                        <span class="block text-[10px] font-semibold uppercase text-slate-500">Resolved</span>
                        <strong class="text-sm font-bold text-emerald-400">{{ $member->completed_tasks_count }}</strong>
                    </div>
                </div>

                <!-- Quick Action -->
                <div class="pt-1">
                    <button 
                        wire:click="openAssignModal({{ $member->id }})" 
                        class="w-full rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-slate-700 py-2 text-xs font-semibold text-slate-300 hover:text-white transition-all flex items-center justify-center gap-1.5"
                    >
                        <svg class="h-3.5 w-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Assign Task
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-slate-800 bg-slate-950 p-12 text-center text-xs text-slate-400">
                No team members found matching your search criteria.
            </div>
        @endforelse
    </div>

    <!-- Quick Assign Modal -->
    <div x-data="{ show: @entangle('showAssignModal') }" x-show="show" x-cloak class="relative z-50">
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div @click.away="$wire.closeAssignModal()" class="relative transform overflow-hidden rounded-2xl bg-slate-900 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-800 p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                        <h3 class="text-base font-bold text-white">Assign Task to Member</h3>
                        <button wire:click="closeAssignModal" class="text-slate-400 hover:text-white">&times;</button>
                    </div>

                    <form wire:submit="assignTask" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1">Select Task to Assign</label>
                            <select wire:model="selectedTaskId" class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-emerald-500 focus:outline-none">
                                <option value="">-- Choose an active task --</option>
                                @foreach($assignableTasks as $t)
                                    <option value="{{ $t->id }}">[{{ $t->task_number }}] {{ $t->title }} ({{ $t->workflow?->title }})</option>
                                @endforeach
                            </select>
                            @error('selectedTaskId') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2">
                            <button type="button" wire:click="closeAssignModal" class="rounded-xl bg-slate-800 px-4 py-2 text-xs font-semibold text-slate-300 hover:text-white">Cancel</button>
                            <button type="submit" class="rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/30">Assign Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
