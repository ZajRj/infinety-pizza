<?php

namespace App\Livewire\Pages\Checkout;

use App\Services\CartService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $address;
    public $notes;
    
    protected $rules = [
        'address' => 'required|string|min:5',
        'notes' => 'nullable|string|max:500',
    ];

    public function mount(CartService $cartService)
    {
        if (count($cartService->getItems()) === 0) {
            return redirect()->route('home');
        }

        if (Auth::check()) {
            $this->address = Auth::user()->address;
        }
    }

    public function increase(CartService $cartService, $itemId)
    {
        $cartService->increaseQuantity($itemId);
        if (count($cartService->getItems()) === 0) return redirect()->route('home');
    }

    public function decrease(CartService $cartService, $itemId)
    {
        $cartService->decreaseQuantity($itemId);
        if (count($cartService->getItems()) === 0) return redirect()->route('home');
    }

    public function removeItem(CartService $cartService, $itemId)
    {
        $cartService->removeItem($itemId);
        if (count($cartService->getItems()) === 0) return redirect()->route('home');
    }

    public function placeOrder(CartService $cartService)
    {
        $this->validate();

        $orderData = [
            'delivery_address' => $this->address,
            'notes' => $this->notes,
        ];

        try {
            $order = $cartService->createOrder($orderData);
            session()->flash('success', 'Order placed successfully! 🍕✨');
            return redirect()->route('home');
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong while placing your order. Please try again.');
        }
    }

    #[Layout('layouts.app')]
    public function render(CartService $cartService)
    {
        return view('livewire.pages.checkout.index', [
            'items' => collect($cartService->getItems()),
            'total' => $cartService->getTotal(),
        ]);
    }
}
