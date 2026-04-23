<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Pizza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Get the current cart instance (from DB or Session).
     */
    public function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        $sessionId = Session::getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    /**
     * Add an item to the cart.
     */
    public function addItem($pizzaId, $quantity = 1, $observations = null)
    {
        $cart = $this->getCart();
        $pizza = Pizza::findOrFail($pizzaId);

        $item = $cart->items()->where('pizza_id', $pizzaId)
            ->where('observations', $observations)
            ->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'pizza_id' => $pizzaId,
                'quantity' => $quantity,
                'observations' => $observations,
                'price' => $pizza->price,
            ]);
        }

        $this->updateSession();
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItem($itemId)
    {
        CartItem::where('id', $itemId)->delete();
        $this->updateSession();
    }

    /**
     * Increase quantity of an item.
     */
    public function increaseQuantity($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->increment('quantity');
        $this->updateSession();
    }

    /**
     * Decrease quantity of an item.
     */
    public function decreaseQuantity($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($item->quantity > 1) {
            $item->decrement('quantity');
        } else {
            $item->delete();
        }
        $this->updateSession();
    }

    /**
     * Sync the DB cart into the session.
     */
    public function syncDbCart()
    {
        if (!Auth::check()) return;

        $userCart = Cart::where('user_id', Auth::id())->with('items')->first();
        
        if ($userCart) {
            $items = $userCart->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'pizza_id' => $item->pizza_id,
                    'name' => $item->pizza->name,
                    'image' => $item->pizza->images[0] ?? 'pizzas/placeholder.png',
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                    'observations' => $item->observations,
                ];
            })->toArray();

            Session::put('cart', $items);
        }
    }

    /**
     * Update the session with the latest cart data.
     */
    protected function updateSession()
    {
        $cart = $this->getCart();
        $items = $cart->items()->with('pizza')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'pizza_id' => $item->pizza_id,
                'name' => $item->pizza->name,
                'image' => $item->pizza->images[0] ?? 'pizzas/placeholder.png',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'observations' => $item->observations,
            ];
        })->toArray();

        Session::put('cart', $items);
    }

    /**
     * Get the total amount of the cart.
     */
    public function getTotal()
    {
        $cart = $this->getCart();
        return $cart->items->sum(fn($item) => $item->price * $item->quantity);
    }

    /**
     * Create an order from the current cart.
     */
    public function createOrder(array $options = [])
    {
        $cart = $this->getCart();
        
        if ($cart->items->isEmpty()) {
            throw new \Exception("Cannot create an order from an empty cart.");
        }

        $orderDetails = $cart->items->map(function ($item) {
            return [
                'pizza_id' => $item->pizza_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'observations' => $item['observations'] ?? null,
            ];
        })->toArray();

        $orderData = [
            'user_id' => Auth::id(),
            'delivery_address' => $options['delivery_address'] ?? Auth::user()->address,
            'notes' => $options['notes'] ?? null,
            'status' => \App\OrderStatus::PENDING,
            'orderDetails' => $orderDetails,
        ];

        $order = $this->orderService->createOrder($orderData);

        // Clear cart after order
        $cart->items()->delete();
        $this->updateSession();

        return $order;
    }

    /**
     * Get items in cart.
     */
    public function getItems()
    {
        return Session::get('cart', []);
    }

    /**
     * Clear the cart.
     */
    public function clear()
    {
        $cart = $this->getCart();
        $cart->items()->delete();
        Session::forget('cart');
    }
}
