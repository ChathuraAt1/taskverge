<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ErrorPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_404_error_page_renders_with_taskverge_theme(): void
    {
        $response = $this->get('/non-existent-endpoint-xyz');

        $response->assertStatus(404);
        $response->assertSee('HTTP 404');
        $response->assertSee('Page Not Found');
        $response->assertSee('TaskVerge');
    }

    public function test_403_error_page_renders_when_access_denied(): void
    {
        $member = User::factory()->create([
            'role' => 'member',
        ]);

        $this->actingAs($member);

        // Admin panel is restricted to super_admin and admin
        $response = $this->get('/app/admin');

        $response->assertStatus(403);
        $response->assertSee('HTTP 403');
        $response->assertSee('Access Restricted');
        $response->assertSee('Return to Dashboard');
    }
}
