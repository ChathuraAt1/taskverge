<?php

namespace Tests\Feature;

use App\Mail\ContactInquiryReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_contact_section_with_branches_and_email(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Get in Touch');
        $response->assertSee('help@taskverge.net');
        $response->assertSee('San Francisco');
        $response->assertSee('London');
        $response->assertSee('+1 (415) 802-2040');
        $response->assertSee('+44 (20) 7946 0830');
        $response->assertSee('Send Message');
    }

    public function test_contact_form_validation_rules(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_sends_email_to_support_recipient(): void
    {
        Mail::fake();

        $formData = [
            'name' => 'Alice Morgan',
            'email' => 'alice@example.com',
            'phone' => '+1 (555) 234-5678',
            'branch' => 'sf',
            'subject' => 'Enterprise Workflow Setup Inquiry',
            'message' => 'We want to migrate our 50-person ops team over to TaskVerge next month.',
        ];

        $response = $this->post('/contact', $formData);

        $response->assertRedirect(route('home') . '#contact');
        $response->assertSessionHas('contact_status', 'Thank you! Your message has been sent to our team at help@taskverge.net. We will get back to you shortly.');

        Mail::assertSent(ContactInquiryReceived::class, function (ContactInquiryReceived $mail) {
            return $mail->hasTo('help@taskverge.net') &&
                $mail->inquiry['name'] === 'Alice Morgan' &&
                $mail->inquiry['email'] === 'alice@example.com' &&
                $mail->inquiry['branch'] === 'sf';
        });
    }

    public function test_contact_form_gracefully_handles_mailer_exception(): void
    {
        Mail::shouldReceive('to')
            ->once()
            ->with('help@taskverge.net')
            ->andReturnSelf();

        Mail::shouldReceive('send')
            ->once()
            ->andThrow(new \Exception('Simulated SMTP connection error'));

        $formData = [
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'message' => 'Testing mail failure resiliency.',
        ];

        $response = $this->post('/contact', $formData);

        $response->assertRedirect(route('home') . '#contact');
        $response->assertSessionHas('contact_status');
    }
}
