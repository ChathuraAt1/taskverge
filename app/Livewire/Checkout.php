<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Enterprise Checkout & License Provisioning')]
class Checkout extends Component
{
    public string $plan = 'intelligence'; // core, intelligence

    public string $billingInterval = 'annual'; // monthly, annual

    public int $seats = 5;

    // Billing Form
    public string $cardholderName = '';

    public string $cardNumber = '';

    public string $cardExpiry = '';

    public string $cardCvc = '';

    public string $postalCode = '';

    public string $country = 'United States';

    public string $companyName = '';

    public string $businessVat = '';

    // Processing State
    public bool $isProcessing = false;

    public string $processingStep = '';

    public function mount(): void
    {
        $requestedPlan = request()->query('plan');
        if (in_array($requestedPlan, ['core', 'intelligence'], true)) {
            $this->plan = $requestedPlan;
        }

        $requestedInterval = request()->query('interval');
        if (in_array($requestedInterval, ['monthly', 'annual', 'yearly'], true)) {
            $this->billingInterval = $requestedInterval === 'yearly' ? 'annual' : $requestedInterval;
        }

        if (Auth::check()) {
            $this->cardholderName = Auth::user()->name;
            $this->companyName = Auth::user()->department ?? 'Enterprise Organization';
        }
    }

    public function setPlan(string $plan): void
    {
        if (in_array($plan, ['core', 'intelligence'], true)) {
            $this->plan = $plan;
        }
    }

    public function setBillingInterval(string $interval): void
    {
        if (in_array($interval, ['monthly', 'annual'], true)) {
            $this->billingInterval = $interval;
        }
    }

    public function incrementSeats(): void
    {
        $this->seats++;
    }

    public function decrementSeats(): void
    {
        if ($this->seats > 1) {
            $this->seats--;
        }
    }

    /**
     * Detect card brand from card number.
     */
    public function getCardBrandProperty(): string
    {
        $clean = preg_replace('/\D/', '', $this->cardNumber);

        if (str_starts_with($clean, '4')) {
            return 'Visa Corporate';
        }

        if (str_starts_with($clean, '5')) {
            return 'Mastercard Enterprise';
        }

        if (str_starts_with($clean, '34') || str_starts_with($clean, '37')) {
            return 'American Express Corporate';
        }

        return 'Corporate Credit Card';
    }

    /**
     * Calculate monthly rate per seat.
     */
    public function getUnitRateProperty(): float
    {
        if ($this->plan === 'intelligence') {
            return $this->billingInterval === 'annual' ? 95.00 : 119.00;
        }

        return $this->billingInterval === 'annual' ? 39.00 : 49.00;
    }

    /**
     * Calculate subtotal.
     */
    public function getSubtotalProperty(): float
    {
        $months = $this->billingInterval === 'annual' ? 12 : 1;

        return round($this->seats * $this->unitRate * $months, 2);
    }

    /**
     * Calculate tax (8.25% corporate tax).
     */
    public function getTaxProperty(): float
    {
        return round($this->subtotal * 0.0825, 2);
    }

    /**
     * Calculate total payable amount.
     */
    public function getTotalProperty(): float
    {
        return round($this->subtotal + $this->tax, 2);
    }

    /**
     * Process payment and license subscription.
     */
    public function processCheckout(): void
    {
        // Enforce user authentication before charging
        if (! Auth::check()) {
            session()->put('intended_checkout', [
                'plan' => $this->plan,
                'interval' => $this->billingInterval,
                'seats' => $this->seats,
            ]);

            $this->redirect(route('login'));

            return;
        }

        $this->validate([
            'cardholderName' => ['required', 'string', 'min:3', 'max:255'],
            'cardNumber' => ['required', 'string', 'min:15'],
            'cardExpiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/?([0-9]{2})$/'],
            'cardCvc' => ['required', 'string', 'min:3', 'max:4'],
            'postalCode' => ['required', 'string', 'min:3', 'max:12'],
            'country' => ['required', 'string'],
        ], [
            'cardNumber.required' => 'Please provide a valid enterprise card number.',
            'cardNumber.min' => 'The card number format is invalid.',
            'cardExpiry.regex' => 'Expiration date must be formatted as MM/YY.',
            'cardCvc.min' => 'Security code must be 3 or 4 digits.',
        ]);

        $cleanCard = preg_replace('/\D/', '', $this->cardNumber);

        // Standard card validation
        if (strlen($cleanCard) < 15 || strlen($cleanCard) > 16) {
            $this->addError('cardNumber', 'The card number entered is not recognized by the corporate payment network.');

            return;
        }

        // Validate expiration date is in the future
        [$expMonth, $expYear] = explode('/', str_replace(' ', '', $this->cardExpiry));
        $fullExpYear = (int) ('20'.$expYear);
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('m');

        if ($fullExpYear < $currentYear || ($fullExpYear === $currentYear && (int) $expMonth < $currentMonth)) {
            $this->addError('cardExpiry', 'The card has expired.');

            return;
        }

        $lastFour = substr($cleanCard, -4);
        $invoiceNumber = 'INV-'.date('Y').'-'.mt_rand(1000, 9999);

        // Record the confirmed enterprise billing transaction
        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoiceNumber,
            'plan_name' => $this->plan === 'intelligence' ? 'Enterprise Intelligence' : 'Operations Core',
            'billing_interval' => $this->billingInterval,
            'seats' => $this->seats,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'currency' => 'USD',
            'payment_status' => 'paid',
            'card_brand' => str_starts_with($cleanCard, '4') ? 'Visa' : (str_starts_with($cleanCard, '5') ? 'Mastercard' : 'Amex'),
            'card_last_four' => $lastFour,
            'receipt_url' => '/invoices/'.strtolower($invoiceNumber),
        ]);

        // Upgrade/Update active user subscription state
        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'subscription_plan' => $this->plan,
            'subscription_status' => 'active',
            'billing_interval' => $this->billingInterval,
            'seats_count' => $this->seats,
        ]);

        session()->flash('status', "Enterprise license successfully provisioned under Invoice {$invoiceNumber}.");

        $this->redirect(route('checkout.success', $order->id), navigate: true);
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
