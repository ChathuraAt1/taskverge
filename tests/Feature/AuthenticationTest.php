<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_successfully_with_nvidia_tech_showcase(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('TaskVerge');
        $response->assertSee('NVIDIA NeMo');
        $response->assertSee('NVIDIA Nemotron');
        $response->assertSee('NVIDIA NIM');
        $response->assertSee('NVIDIA Triton');
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Sign in to TaskVerge');
    }

    public function test_user_can_authenticate_using_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'operator@taskverge.com',
            'password' => bcrypt('password'),
            'role' => 'operator',
        ]);

        $response = $this->post('/login', [
            'email' => 'operator@taskverge.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard'));
    }

    public function test_user_cannot_authenticate_with_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'operator@taskverge.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'email' => 'operator@taskverge.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_quick_login_persona_switching_works(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@taskverge.com',
            'role' => 'admin',
        ]);

        $response = $this->post(route('quick-login', $admin));

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('dashboard'));
    }

    public function test_user_can_register_new_enterprise_account(): void
    {
        $response = $this->post('/register', [
            'name' => 'Jordan Miller',
            'email' => 'jordan@taskverge.com',
            'department' => 'Enterprise Operations',
            'role' => 'manager',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'jordan@taskverge.com',
            'department' => 'Enterprise Operations',
            'role' => 'manager',
        ]);
        $response->assertRedirect(route('dashboard'));
    }

    public function test_user_can_log_out(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('home'));
    }
}
