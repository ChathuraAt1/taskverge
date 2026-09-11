<?php

namespace Tests\Feature;

use App\Livewire\AdminPanel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_access_admin_panel(): void
    {
        $superAdmin = User::factory()->create([
            'email' => 'superadmin@taskverge.com',
            'role' => 'super_admin',
        ]);

        $this->actingAs($superAdmin)
            ->get(route('admin.panel'))
            ->assertStatus(200)
            ->assertSee('User Management');
    }

    public function test_admin_can_access_admin_panel(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@taskverge.com',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.panel'))
            ->assertStatus(200)
            ->assertSee('User Management');
    }

    public function test_regular_member_cannot_access_admin_panel(): void
    {
        $member = User::factory()->create([
            'email' => 'member@taskverge.com',
            'role' => 'member',
        ]);

        $this->actingAs($member)
            ->get(route('admin.panel'))
            ->assertStatus(403);
    }

    public function test_operator_cannot_access_admin_panel(): void
    {
        $operator = User::factory()->create([
            'email' => 'operator@taskverge.com',
            'role' => 'operator',
        ]);

        $this->actingAs($operator)
            ->get(route('admin.panel'))
            ->assertStatus(403);
    }

    public function test_super_admin_can_update_user_role(): void
    {
        $superAdmin = User::factory()->create([
            'email' => 'superadmin@taskverge.com',
            'role' => 'super_admin',
        ]);

        $member = User::factory()->create([
            'email' => 'candidate@taskverge.com',
            'role' => 'member',
        ]);

        Livewire::actingAs($superAdmin)
            ->test(AdminPanel::class)
            ->call('editUser', $member->id)
            ->set('editRole', 'manager')
            ->call('saveUser');

        $member->refresh();
        $this->assertEquals('manager', $member->role);
    }

    public function test_super_admin_can_toggle_user_active_status(): void
    {
        $superAdmin = User::factory()->create([
            'email' => 'superadmin@taskverge.com',
            'role' => 'super_admin',
        ]);

        $member = User::factory()->create([
            'email' => 'activeuser@taskverge.com',
            'is_active' => true,
        ]);

        Livewire::actingAs($superAdmin)
            ->test(AdminPanel::class)
            ->call('toggleActive', $member->id);

        $member->refresh();
        $this->assertFalse($member->is_active);
    }

    public function test_regular_admin_cannot_promote_to_admin_role(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@taskverge.com',
            'role' => 'admin',
        ]);

        $member = User::factory()->create([
            'email' => 'candidate@taskverge.com',
            'role' => 'member',
        ]);

        Livewire::actingAs($admin)
            ->test(AdminPanel::class)
            ->call('editUser', $member->id)
            ->set('editRole', 'admin')
            ->call('saveUser');

        $member->refresh();
        $this->assertEquals('member', $member->role);
    }
}
