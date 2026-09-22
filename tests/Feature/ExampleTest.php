<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_privacy_policy_page_renders_successfully_with_contact_details(): void
    {
        $response = $this->get('/privacy');

        $response->assertStatus(200);
        $response->assertSee('Privacy Policy');
        $response->assertSee('September 22, 2026');
        $response->assertSee('Taskverge PVT LTD');
        $response->assertSee('165/7 Pickerings Road, Colombo 01500, Sri Lanka');
        $response->assertSee('Taskverge LLC');
        $response->assertSee('255 Ferry Blvd, Stratford, CT 06615, United States');
        $response->assertSee('help@taskverge.net');
        $response->assertSee('+94717285555');
        $response->assertSee('+12038708505');
    }

    public function test_terms_page_renders_successfully_with_contact_details(): void
    {
        $response = $this->get('/terms');

        $response->assertStatus(200);
        $response->assertSee('Terms and Conditions');
        $response->assertSee('September 22, 2026');
        $response->assertSee('Taskverge PVT LTD');
        $response->assertSee('165/7 Pickerings Road, Colombo 01500, Sri Lanka');
        $response->assertSee('Taskverge LLC');
        $response->assertSee('255 Ferry Blvd, Stratford, CT 06615, United States');
        $response->assertSee('help@taskverge.net');
        $response->assertSee('+94717285555');
        $response->assertSee('+12038708505');
    }

    public function test_landing_page_includes_chatbot_and_cookie_consent(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Ask AI');
        $response->assertSee('TaskVerge Copilot');
        $response->assertSee('Cookie &amp; Privacy Choices', false);
    }

    public function test_landing_chatbot_livewire_component_responds_to_queries(): void
    {
        \Livewire\Livewire::test(\App\Livewire\LandingChatbot::class)
            ->assertSee('TaskVerge AI Assistant')
            ->set('inputMessage', 'What is TaskVerge?')
            ->call('sendMessage')
            ->assertSet('inputMessage', '')
            ->assertSee('Autonomous Workflow Intelligence platform');
    }
}



