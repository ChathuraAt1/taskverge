<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Admin Panel')]
class AdminPanel extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = 'all';
    public bool $showEditModal = false;
    public ?int $editingUserId = null;
    public string $editRole = '';
    public bool $editActive = true;

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless($user && ($user->isSuperAdmin() || $user->isAdmin()), 403);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedRoleFilter(): void
    {
        $this->resetPage();
    }

    public function editUser(int $userId): void
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $user->id;
        $this->editRole = $user->role;
        $this->editActive = $user->is_active;
        $this->showEditModal = true;
    }

    public function saveUser(): void
    {
        $user = User::findOrFail($this->editingUserId);

        // Prevent modifying super_admin role
        if ($user->isSuperAdmin()) {
            session()->flash('error', 'Cannot modify the super admin account.');
            $this->closeModal();
            return;
        }

        // Only super_admin can promote to admin
        $currentUser = Auth::user();
        if ($this->editRole === 'admin' && !$currentUser->isSuperAdmin()) {
            session()->flash('error', 'Only the super admin can assign admin roles.');
            $this->closeModal();
            return;
        }

        $user->update([
            'role' => $this->editRole,
            'is_active' => $this->editActive,
        ]);

        session()->flash('status', "User {$user->name} updated successfully.");
        $this->closeModal();
    }

    public function toggleActive(int $userId): void
    {
        $user = User::findOrFail($userId);
        if ($user->isSuperAdmin()) return;

        $user->update(['is_active' => !$user->is_active]);
        session()->flash('status', $user->name . ($user->is_active ? ' activated.' : ' deactivated.'));
    }

    public function closeModal(): void
    {
        $this->showEditModal = false;
        $this->editingUserId = null;
    }

    public function render()
    {
        $query = User::query()
            ->where('role', '!=', 'super_admin');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->roleFilter !== 'all') {
            $query->where('role', $this->roleFilter);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        $stats = [
            'total' => User::where('role', '!=', 'super_admin')->count(),
            'active' => User::where('role', '!=', 'super_admin')->where('is_active', true)->count(),
            'admins' => User::where('role', 'admin')->count(),
            'members' => User::where('role', 'member')->count(),
        ];

        return view('livewire.admin-panel', [
            'users' => $users,
            'stats' => $stats,
        ]);
    }
}
