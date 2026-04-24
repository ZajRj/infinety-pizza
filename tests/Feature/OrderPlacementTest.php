<?php

namespace Tests\Feature;

use App\Events\OrderCreated;
use App\Models\Category;
use App\Models\Pizza;
use App\Models\User;
use App\OrderStatus;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderPlacementTest extends TestCase
{
    use RefreshDatabase;

    protected OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderService = app(OrderService::class);
    }

    public function test_order_can_be_created_with_details()
    {
        Event::fake([OrderCreated::class]);

        // 1. Arrange: Create data using factories
        $user = User::factory()->create();
        $pizza = Pizza::factory()->create([
            'name' => 'Margherita',
            'price' => 10.00,
        ]);

        $orderData = [
            'user_id' => $user->id,
            'delivery_address' => 'Test Address 123',
            'status' => OrderStatus::PENDING,
            'orderDetails' => [
                [
                    'pizza_id' => $pizza->id,
                    'price' => 10.00,
                    'quantity' => 2,
                    'observations' => 'Extra cheese',
                ]
            ],
        ];

        // 2. Act: Create the order
        $order = $this->orderService->createOrder($orderData);

        // 3. Assert: Verify DB
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $user->id,
            'total' => 20.00,
        ]);

        $this->assertDatabaseHas('order_details', [
            'order_id' => $order->id,
            'pizza_id' => $pizza->id,
            'quantity' => 2,
            'observations' => 'Extra cheese',
        ]);

        // Verify Event was fired
        Event::assertDispatched(OrderCreated::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }
}
