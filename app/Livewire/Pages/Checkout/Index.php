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

    public function messages()
    {
        return [
            'address.required' => __('Please provide a delivery address.'),
            'notes.max' => __('Special instructions are too long (max 500 characters).'),
        ];
    }

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
            session()->flash('success', __('Order placed successfully!'));
            return redirect()->route('home');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: __('Something went wrong while placing your order. Please try again.'), type: 'error');
        }
    }

    #[Layout('layouts.app')]
    public function render(CartService $cartService)
    {
        try {
            return view('livewire.pages.checkout.index', [
                'items' => collect($cartService->getItems()),
                'total' => $cartService->getTotal()
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Checkout Component Error: " . $e->getMessage());
            $this->dispatch('notify', message: __('There was an error loading your selection. Please try again.'), type: 'error');

            return view('livewire.pages.checkout.index', [
                'items' => collect(),
                'total' => 0
            ]);
        }
    }
}
