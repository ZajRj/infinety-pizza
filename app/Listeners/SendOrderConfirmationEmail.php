<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $customer = $order->user;

        // Log it for now to prove it works
        Log::info("Sending order confirmation email for Order #{$order->id} to {$customer->email}");

        // In a real app:
        // Mail::to($customer->email)->send(new OrderConfirmationMail($order));
    }
}
