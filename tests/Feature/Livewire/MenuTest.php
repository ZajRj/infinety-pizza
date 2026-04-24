<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Home\Menu;
use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_component_renders_successfully()
    {
        Livewire::test(Menu::class)
            ->assertStatus(200);
    }

    public function test_menu_displays_pizzas()
    {
        // Arrange
        $pizza = Pizza::factory()->create([
            'name' => 'Margherita',
            'price' => 10.00,
        ]);

        // Act & Assert
        Livewire::test(Menu::class)
            ->assertSee('Margherita')
            ->assertSee('10.00');
    }

    public function test_menu_filters_by_category()
    {
        // Arrange
        $cat1 = Category::factory()->create(['name' => 'Classic']);
        $cat2 = Category::factory()->create(['name' => 'Premium']);

        Pizza::factory()->create([
            'name' => 'Margherita',
            'category_id' => $cat1->id,
        ]);

        Pizza::factory()->create([
            'name' => 'Truffle',
            'category_id' => $cat2->id,
        ]);

        // Act & Assert: Filter by Classic
        Livewire::test(Menu::class)
            ->set('categoryId', $cat1->id)
            ->assertSee('Margherita')
            ->assertDontSee('Truffle');

        // Filter by Premium
        Livewire::test(Menu::class)
            ->set('categoryId', $cat2->id)
            ->assertSee('Truffle')
            ->assertDontSee('Margherita');
    }
}
