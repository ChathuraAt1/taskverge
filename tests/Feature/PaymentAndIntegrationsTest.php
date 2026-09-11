<?php

namespace Tests\Feature;

use App\Livewire\Checkout;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentAndIntegrationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_auth_redirect_route_checks_configuration(): void
    {
        // When client_id is not set, it should redirect to login with informational message
        config(['services.google.client_id' => null]);

        $response = $this->get(route('auth.google'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
    }

    public function test_cloudflare_turnstile_renders_on_login_and_register(): void
    {
        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('CLOUDFLARE');
        $loginResponse->assertSee('Continue with Google Workspace');

        $registerResponse = $this->get('/register');
        $registerResponse->assertStatus(200);
        $registerResponse->assertSee('CLOUDFLARE');
        $registerResponse->assertSee('Sign up with Google Workspace');
    }

    public function test_checkout_page_renders_with_plan_options(): void
    {
        $response = $this->get('/checkout?plan=intelligence');

        $response->assertStatus(200);
        $response->assertSee('Enterprise Intelligence');
        $response->assertSee('Operations Core');
        $response->assertSee('CLOUDFLARE');
    }

    public function test_checkout_successfully_processes_corporate_card_4242(): void
    {
        $user = User::factory()->create([
            'name' => 'Dr. Elena Rostova',
            'email' => 'elena@taskverge.com',
            'role' => 'manager',
            'subscription_plan' => 'core',
        ]);

        Livewire::actingAs($user)
            ->test(Checkout::class)
            ->set('plan', 'intelligence')
            ->set('billingInterval', 'annual')
            ->set('seats', 8)
            ->set('cardholderName', 'Dr. Elena Rostova')
            ->set('cardNumber', '4242 4242 4242 4242')
            ->set('cardExpiry', '12/29')
            ->set('cardCvc', '842')
            ->set('postalCode', '94105')
            ->set('country', 'United States')
            ->call('processCheckout')
            ->assertHasNoErrors();

        // Verify order created in database
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'plan_name' => 'Enterprise Intelligence',
            'billing_interval' => 'annual',
            'seats' => 8,
            'payment_status' => 'paid',
            'card_last_four' => '4242',
        ]);

        // Verify user subscription state updated
        $user->refresh();
        $this->assertEquals('intelligence', $user->subscription_plan);
        $this->assertEquals('active', $user->subscription_status);
        $this->assertEquals(8, $user->seats_count);
    }

    public function test_checkout_rejects_expired_cards(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Checkout::class)
            ->set('cardholderName', 'Marcus Vance')
            ->set('cardNumber', '4242 4242 4242 4242')
            ->set('cardExpiry', '01/20') // Past year
            ->set('cardCvc', '123')
            ->set('postalCode', '10001')
            ->call('processCheckout')
            ->assertHasErrors(['cardExpiry']);

        $this->assertEquals(0, Order::count());
    }

    public function test_checkout_ui_contains_no_forbidden_dummy_or_test_words(): void
    {
        $response = $this->get('/checkout');

        $content = strtolower($response->getContent());

        $this->assertStringNotContainsString('dummy', $content);
        $this->assertStringNotContainsString('fake card', $content);
        $this->assertStringNotContainsString('sandbox card', $content);
        $this->assertStringNotContainsString('mock card', $content);
    }

    public function test_checkout_success_receipt_renders_invoice_for_owner(): void
    {
        $user = User::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'invoice_number' => 'INV-2026-8812',
            'plan_name' => 'Enterprise Intelligence',
            'billing_interval' => 'annual',
            'seats' => 5,
            'subtotal' => 5700.00,
            'tax' => 470.25,
            'total' => 6170.25,
            'currency' => 'USD',
            'payment_status' => 'paid',
            'card_brand' => 'Visa',
            'card_last_four' => '4242',
        ]);

        $response = $this->actingAs($user)->get(route('checkout.success', $order));

        $response->assertStatus(200);
        $response->assertSee('INV-2026-8812');
        $response->assertSee('ending in');
        $response->assertSee('4242');
        $response->assertSee('6,170.25');
    }
}
