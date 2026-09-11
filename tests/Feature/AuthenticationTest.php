<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_successfully_with_commercial_content(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('TaskVerge');
        $response->assertSee('About Us');
        $response->assertSee('What It Does');
        $response->assertSee('How It Works');
        $response->assertSee('Customer Stories');
        $response->assertSee('Key Benefits');
        $response->assertSee('Pricing Plans');
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

    public function test_user_can_register_new_account(): void
    {
        $response = $this->post('/register', [
            'name' => 'Jordan Miller',
            'email' => 'jordan@taskverge.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'jordan@taskverge.com',
            'role' => 'member',
            'subscription_plan' => 'free',
            'subscription_status' => 'trialing',
        ]);
        $response->assertRedirect(route('dashboard'));
    }

    public function test_demo_personas_hidden_and_quick_login_forbidden_in_production(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@taskverge.com',
            'role' => 'admin',
        ]);

        $this->app['env'] = 'production';

        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertDontSee('1-Click Evaluation Personas');

        $quickLoginResponse = $this->withoutMiddleware()->post(route('quick-login', $admin));
        $quickLoginResponse->assertStatus(404);
    }

    public function test_user_can_log_out(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('home'));
    }
}
