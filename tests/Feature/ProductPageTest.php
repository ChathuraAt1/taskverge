<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_page_renders_with_cortex_and_nvidia_sdks(): void
    {
        $response = $this->get('/product');

        $response->assertStatus(200);
        $response->assertSee('TaskVerge');
        $response->assertSee('Cortex');
        $response->assertSee('NVIDIA NeMo');
        $response->assertSee('NVIDIA Nemotron');
        $response->assertSee('NVIDIA NIM');
        $response->assertSee('NVIDIA Triton');
        $response->assertSee('NVIDIA TensorRT-LLM');
        $response->assertSee('LoRA');
        $response->assertSee('vLLM');
        $response->assertSee('Vector RAG Fabric');
        $response->assertSee('Launch Live Workspace');
        $response->assertDontSee('PHP 8.2+ / Laravel 12');
    }

    public function test_navbar_renders_cortex_cta(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Cortex™ Engine');
        $response->assertSee(route('product'));
    }

    public function test_hero_primary_cta_links_to_product_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Explore TaskVerge Cortex');
        $response->assertSee(route('product'));
    }

    public function test_footer_renders_social_links(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('https://medium.com/@taskverg');
        $response->assertSee('https://www.youtube.com/@Taskverge');
        $response->assertSee('https://www.facebook.com/taskverge/');
        $response->assertSee('fa-brands fa-medium');
        $response->assertSee('fa-brands fa-youtube');
        $response->assertSee('fa-brands fa-facebook-f');
    }

    public function test_product_page_cta_links_to_dashboard(): void
    {
        $response = $this->get('/product');

        $response->assertStatus(200);
        $response->assertSee(route('dashboard'));
    }

    public function test_authenticated_user_sees_compact_dashboard_in_navbar(): void
    {
        $user = User::factory()->create([
            'role' => 'operator',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Cortex™ Engine');
    }
}
