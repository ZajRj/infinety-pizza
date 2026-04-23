<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;
use Livewire\Attributes\On;

class CartDrawer extends Component
{
    public $items = [];
    public $total = 0;

    public function mount(CartService $cartService)
    {
        $this->refreshCart($cartService);
    }

    #[On('add-to-cart')]
    public function addItem(CartService $cartService, $pizzaId, $quantity = 1, $observations = null)
    {
        $cartService->addItem($pizzaId, $quantity, $observations);
        $this->refreshCart($cartService);
        $this->dispatch('cart-updated', count: count($this->items));
    }

    public function removeItem(CartService $cartService, $itemId)
    {
        $cartService->removeItem($itemId);
        $this->refreshCart($cartService);
        $this->dispatch('cart-updated', count: count($this->items));
    }

    public function increase(CartService $cartService, $itemId)
    {
        $cartService->increaseQuantity($itemId);
        $this->refreshCart($cartService);
        $this->dispatch('cart-updated', count: count($this->items));
    }

    public function decrease(CartService $cartService, $itemId)
    {
        $cartService->decreaseQuantity($itemId);
        $this->refreshCart($cartService);
        $this->dispatch('cart-updated', count: count($this->items));
    }

    protected function refreshCart(CartService $cartService)
    {
        $this->items = $cartService->getItems();
        $this->total = $cartService->getTotal();
    }

    public function render()
    {
        return view('livewire.cart-drawer');
    }
}
