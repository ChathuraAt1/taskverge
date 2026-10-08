<?php

namespace Tests\Feature;

use App\Livewire\Checkout;
use App\Mail\ContactInquiryReceived;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class TurnstileVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_rejects_missing_and_invalid_tokens_without_sending_mail(): void
    {
        Mail::fake();

        $data = [
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'message' => 'A question about the service.',
        ];

        $this->postJson('/contact', $data)
            ->assertUnprocessable()
            ->assertJsonValidationErrors('cf-turnstile-response');

        Http::fake(['challenges.cloudflare.com/*' => Http::response(['success' => false])]);

        $this->postJson('/contact', $data + ['cf-turnstile-response' => 'forged'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('cf-turnstile-response');

        Mail::assertNotSent(ContactInquiryReceived::class);
    }

    public function test_login_rejects_a_token_with_the_wrong_action(): void
    {
        User::factory()->create([
            'email' => 'alice@example.com',
            'password' => bcrypt('password'),
        ]);

        Http::fake(['challenges.cloudflare.com/*' => Http::response([
            'success' => true,
            'action' => 'contact',
            'hostname' => 'localhost',
        ])]);

        $this->post('/login', [
            'email' => 'alice@example.com',
            'password' => 'password',
            'cf-turnstile-response' => 'wrong-action-token',
        ])->assertSessionHasErrors('cf-turnstile-response');

        $this->assertGuest();
    }

    public function test_checkout_requires_a_valid_token_before_creating_an_order(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Checkout::class)
            ->set('cardholderName', 'Alice Morgan')
            ->set('cardNumber', '4242 4242 4242 4242')
            ->set('cardExpiry', '12/29')
            ->set('cardCvc', '123')
            ->set('postalCode', '10001')
            ->call('processCheckout')
            ->assertHasErrors(['cf-turnstile-response']);

        $this->assertSame(0, Order::count());
    }

    public function test_contact_rejects_a_token_for_another_hostname(): void
    {
        Mail::fake();

        Http::fake(['challenges.cloudflare.com/*' => Http::response([
            'success' => true,
            'action' => 'contact',
            'hostname' => 'other.example',
        ])]);

        $this->postJson('/contact', [
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'message' => 'A question about the service.',
            'cf-turnstile-response' => 'wrong-host-token',
        ])->assertUnprocessable()->assertJsonValidationErrors('cf-turnstile-response');

        Mail::assertNotSent(ContactInquiryReceived::class);
    }
}
