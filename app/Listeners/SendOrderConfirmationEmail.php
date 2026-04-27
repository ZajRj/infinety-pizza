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

        // Send the confirmation email with the correct locale
        \Illuminate\Support\Facades\Mail::to($customer->email)
            ->locale($event->locale)
            ->send(new \App\Mail\OrderConfirmation($order));
    }
}
