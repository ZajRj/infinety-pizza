<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Pizza;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new order with its details.
     */
    public function createOrder(array $data): Order
    {
        try {
            return DB::transaction(function () use ($data) {
                // 1. Create the Order
                $order = Order::create([
                    'user_id' => $data['user_id'],
                    'delivery_address' => $data['delivery_address'] ?? null,
                    'notes' => $data['notes'] ?? null,
                    'status' => $data['status'],
                    'total' => $this->calculateTotal($data['orderDetails'] ?? []),
                ]);

                // 2. Create Order Details
                if (!empty($data['orderDetails'])) {
                    foreach ($data['orderDetails'] as $item) {
                        $pizza = Pizza::find($item['pizza_id']);
                        $order->orderDetails()->create([
                            'pizza_id' => $item['pizza_id'],
                            'pizza_name' => $pizza?->name ?? 'Unknown Pizza',
                            'price' => $item['price'] ?? $pizza?->price ?? 0,
                            'quantity' => $item['quantity'] ?? 1,
                            'observations' => $item['observations'] ?? null,
                        ]);
                    }
                }

                $order = $order->load(['orderDetails.pizza.ingredients', 'user']);
                event(new \App\Events\OrderCreated($order));

                return $order;
            });
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to create order: " . $e->getMessage(), [
                'data' => $data,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Update an existing order.
     */
    public function updateOrder(Order $order, array $data): Order
    {
        return DB::transaction(function () use ($order, $data) {
            // Update main order
            $order->update([
                'user_id' => $data['user_id'] ?? $order->user_id,
                'delivery_address' => $data['delivery_address'] ?? $order->delivery_address,
                'status' => $data['status'] ?? $order->status,
                'total' => $this->calculateTotal($data['orderDetails'] ?? []),
            ]);

            // Sync Order Details (Simple approach: delete and recreate)
            if (isset($data['orderDetails'])) {
                $order->orderDetails()->delete();
                foreach ($data['orderDetails'] as $item) {
                    $pizza = Pizza::find($item['pizza_id']);
                    $order->orderDetails()->create([
                        'pizza_id' => $item['pizza_id'],
                        'pizza_name' => $pizza?->name ?? 'Unknown Pizza',
                        'price' => $item['price'] ?? $pizza?->price ?? 0,
                        'quantity' => $item['quantity'] ?? 1,
                        'observations' => $item['observations'] ?? null,
                    ]);
                }
            }

            return $order;
        });
    }

    /**
     * Calculate the total amount for the order items.
     */
    public function calculateTotal(array $items): float
    {
        return collect($items)->reduce(function ($total, $item) {
            $quantity = $item['quantity'] ?? 1;
            $price = $item['price'] ?? 0;
            return $total + ($price * $quantity);
        }, 0);
    }
}
