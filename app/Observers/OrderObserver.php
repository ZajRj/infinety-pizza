<?php

namespace App\Observers;

use App\Events\OrderCancelled;
use App\Models\Order;
use App\OrderStatus;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Log::info("NEW ORDER CREATED: Order #{$order->id} for Customer ID: {$order->user_id}. Total: {$order->total}");
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Check if the status was changed to cancelled
        if ($order->isDirty('status') && $order->status === OrderStatus::CANCELLED) {
            Log::warning("ORDER CANCELLED: Order #{$order->id} has been cancelled.");
            
            // Dispatch the specific cancellation event
            OrderCancelled::dispatch($order);
        }
    }
}
