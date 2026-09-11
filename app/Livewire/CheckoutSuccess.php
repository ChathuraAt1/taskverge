<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Payment Receipt & Provisioning Confirmation')]
class CheckoutSuccess extends Component
{
    public Order $order;

    public function mount(Order $order): void
    {
        // Enforce that user owns this order
        if (Auth::id() !== $order->user_id && ! Auth::user()?->isAdmin()) {
            abort(403, 'Unauthorized invoice access.');
        }

        $this->order = $order->load('user');
    }

    public function render()
    {
        return view('livewire.checkout-success');
    }
}
