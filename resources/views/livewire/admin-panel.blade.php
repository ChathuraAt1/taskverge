<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight">User Management</h2>
            <p class="text-sm text-slate-400 mt-1">Manage accounts, roles and permissions</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <p class="text-sm font-medium text-slate-400">Total Users</p>
            <p class="mt-2 text-2xl font-bold text-white">{{ $stats['total'] }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <p class="text-sm font-medium text-slate-400">Active Users</p>
            <p class="mt-2 text-2xl font-bold text-white">{{ $stats['active'] }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <p class="text-sm font-medium text-slate-400">Admins</p>
            <p class="mt-2 text-2xl font-bold text-white">{{ $stats['admins'] }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <p class="text-sm font-medium text-slate-400">Members</p>
            <p class="mt-2 text-2xl font-bold text-white">{{ $stats['members'] }}</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="w-full sm:max-w-xs relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" wire:model.live="search" class="block w-full rounded-lg border-0 bg-slate-900 py-2 pl-10 pr-3 text-sm text-white ring-1 ring-inset ring-slate-800 focus:ring-2 focus:ring-inset focus:ring-emerald-500 placeholder:text-slate-500" placeholder="Search users...">
        </div>
        
        <select wire:model.live="roleFilter" class="block w-full sm:w-48 rounded-lg border-0 bg-slate-900 py-2 pl-3 pr-10 text-sm text-white ring-1 ring-inset ring-slate-800 focus:ring-2 focus:ring-inset focus:ring-emerald-500">
            <option value="all">All Roles</option>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="operator">Operator</option>
            <option value="member">Member</option>
        </select>
    </div>

    <!-- Users Table -->
    <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-800 text-left text-sm">
                <thead class="bg-slate-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-slate-400">User</th>
                        <th scope="col" class="px-6 py-4 font-medium text-slate-400">Role</th>
                        <th scope="col" class="px-6 py-4 font-medium text-slate-400">Plan</th>
                        <th scope="col" class="px-6 py-4 font-medium text-slate-400">Status</th>
                        <th scope="col" class="px-6 py-4 font-medium text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="h-9 w-9 rounded-full bg-slate-800 object-cover" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                    <div>
                                        <div class="font-medium text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded px-2 py-1 text-xs font-medium ring-1 ring-inset
                                    @if($user->role === 'admin') bg-purple-500/10 text-purple-400 ring-purple-500/20
                                    @elseif($user->role === 'manager') bg-teal-500/10 text-teal-400 ring-teal-500/20
                                    @elseif($user->role === 'operator') bg-emerald-500/10 text-emerald-400 ring-emerald-500/20
                                    @else bg-slate-500/10 text-slate-400 ring-slate-500/20
                                    @endif
                                ">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-slate-300">{{ $user->subscription_plan ? ucfirst($user->subscription_plan) : 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleActive({{ $user->id }})" class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 {{ $user->is_active ? 'bg-emerald-600' : 'bg-slate-700' }}" role="switch" aria-checked="{{ $user->is_active ? 'true' : 'false' }}">
                                    <span aria-hidden="true" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $user->is_active ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                </button>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button wire:click="editUser({{ $user->id }})" class="text-emerald-400 hover:text-emerald-300 font-medium text-sm transition-colors">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-400">
                                No users found matching your criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="border-t border-slate-800 p-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Edit User Modal -->
    @if($showEditModal)
    <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-xl bg-slate-900 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-800">
                    <div class="bg-slate-900 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title">Edit User</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="role" class="block text-sm font-medium leading-6 text-slate-300">Role</label>
                                        <select wire:model="editRole" id="role" class="mt-1 block w-full rounded-md border-0 bg-slate-950 py-2 pl-3 pr-10 text-white ring-1 ring-inset ring-slate-800 focus:ring-2 focus:ring-inset focus:ring-emerald-500 sm:text-sm sm:leading-6">
                                            <option value="member">Member</option>
                                            <option value="operator">Operator</option>
                                            <option value="manager">Manager</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center">
                                        <button type="button" wire:click="$toggle('editActive')" class="relative inline-flex h-5 w-9 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 {{ $editActive ? 'bg-emerald-600' : 'bg-slate-700' }}" role="switch" aria-checked="{{ $editActive ? 'true' : 'false' }}">
                                            <span aria-hidden="true" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $editActive ? 'translate-x-4' : 'translate-x-0' }}"></span>
                                        </button>
                                        <span class="ml-3 text-sm text-slate-300" id="active-status">Active Account</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" wire:click="saveUser" class="inline-flex w-full justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 sm:ml-3 sm:w-auto transition-colors">Save Changes</button>
                        <button type="button" wire:click="closeModal" class="mt-3 inline-flex w-full justify-center rounded-md bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-300 shadow-sm ring-1 ring-inset ring-slate-700 hover:bg-slate-700 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
