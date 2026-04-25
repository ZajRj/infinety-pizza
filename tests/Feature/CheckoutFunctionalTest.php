<?php

namespace Tests\Feature;

use App\Events\OrderCreated;
use App\Models\Pizza;
use App\Models\User;
use App\Models\Category;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Pages\Checkout\Index as CheckoutPage;

class CheckoutFunctionalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test order creation with an authenticated user.
     * Also covers event firing.
     */
    public function test_authenticated_user_can_place_order_and_triggers_event()
    {
        Event::fake([OrderCreated::class]);

        // Arrange: Create user and pizza
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $pizza = Pizza::factory()->create([
            'name' => 'Artisanal Carbonara',
            'price' => 15.00,
            'category_id' => $category->id
        ]);

        // Act: Add item to cart and act as user
        $this->actingAs($user);
        
        $cartService = app(CartService::class);
        $cartService->addItem($pizza->id, 1);

        // Interact with the Checkout Livewire component
        Livewire::test(CheckoutPage::class)
            ->set('address', 'Calle Artisanal 123')
            ->set('notes', 'Please knock loudly')
            ->call('placeOrder')
            ->assertRedirect(route('home'))
            ->assertSessionHas('success');

        // Assert: Verify order in DB
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'delivery_address' => 'Calle Artisanal 123',
            'total' => 15.00
        ]);

        // Assert: Verify event was fired
        Event::assertDispatched(OrderCreated::class);
    }

    /**
     * Test redirection of unauthenticated user (intended URL logic).
     */
    public function test_unauthenticated_user_is_redirected_to_login_and_back_to_checkout()
    {
        // 1. Try to visit checkout as guest
        $response = $this->get(route('checkout'));
        
        // Assert redirected to login
        $response->assertRedirect(route('login'));

        // 2. Login the user
        $user = User::factory()->create([
            'password' => bcrypt($password = 'artisanal-pass-123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        // 3. Assert redirected back to checkout (Intended URL)
        $response->assertRedirect(route('checkout'));
    }

    /**
     * Test cart merging on login.
     */
    public function test_guest_cart_merges_on_login()
    {
        // Arrange: Create pizza
        $category = Category::factory()->create();
        $pizza = Pizza::factory()->create(['price' => 12.00, 'category_id' => $category->id]);
        $user = User::factory()->create();

        // 1. Act: Add to cart as guest
        $cartService = app(CartService::class);
        $cartService->addItem($pizza->id, 2); // 24.00 total
        
        $this->assertEquals(24.00, $cartService->getTotal());

        // 2. Login the user
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password', // Default factory password
        ]);

        // 3. Assert: Cart is merged and still has the items
        // After login, the listener should have moved items to DB
        $this->actingAs($user);
        $this->assertEquals(24.00, $cartService->getTotal());
        $this->assertDatabaseHas('cart_items', [
            'pizza_id' => $pizza->id,
            'quantity' => 2
        ]);
    }
}
