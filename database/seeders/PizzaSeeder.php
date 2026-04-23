<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Pizza;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $traditional = Category::where('name', 'Tradicionales')->first();
        $premium = Category::where('name', 'Premium')->first();
        $veggie = Category::where('name', 'Vegetarianas')->first();

        // 1. Margherita
        $margherita = Pizza::create([
            'category_id' => $traditional->id,
            'name' => 'Margherita',
            'slug' => 'margherita',
            'description' => 'La clásica italiana con tomate, mozzarella y albahaca fresca.',
            'price' => 12.00,
            'images' => ['pizzas/margherita.png'],
        ]);
        $margherita->ingredients()->attach(
            Ingredient::whereIn('name', ['Tomate', 'Mozzarella'])->pluck('id')
        );

        // 2. Pepperoni
        $pepperoni = Pizza::create([
            'category_id' => $traditional->id,
            'name' => 'Pepperoni',
            'slug' => 'pepperoni',
            'description' => 'Deliciosa combinación de pepperoni americano y mozzarella.',
            'price' => 14.50,
            'images' => ['pizzas/pepperoni.png'],
        ]);
        $pepperoni->ingredients()->attach(
            Ingredient::whereIn('name', ['Tomate', 'Mozzarella', 'Pepperoni'])->pluck('id')
        );

        // 3. Carbonara
        $carbonara = Pizza::create([
            'category_id' => $premium->id,
            'name' => 'Carbonara Gourmet',
            'slug' => 'carbonara-gourmet',
            'description' => 'Base blanca cremosa con bacon, cebolla y un toque de parmesano.',
            'price' => 16.00,
            'images' => ['pizzas/carbonara.png'],
        ]);
        $carbonara->ingredients()->attach(
            Ingredient::whereIn('name', ['Carbonara', 'Mozzarella', 'Bacon', 'Cebolla', 'Parmesano'])->pluck('id')
        );

        // 4. Veggie Delight
        $veggieP = Pizza::create([
            'category_id' => $veggie->id,
            'name' => 'Huerta Fresca',
            'slug' => 'huerta-fresca',
            'description' => 'Cargada de pimientos, champiñones, cebolla y aceitunas negras.',
            'price' => 13.50,
            'images' => ['pizzas/veggie.png'],
        ]);
        $veggieP->ingredients()->attach(
            Ingredient::whereIn('name', ['Tomate', 'Mozzarella', 'Pimientos', 'Champiñones', 'Cebolla', 'Aceitunas Negras'])->pluck('id')
        );

        // 5. BBQ Chicken
        $bbq = Pizza::create([
            'category_id' => $traditional->id,
            'name' => 'BBQ Chicken',
            'slug' => 'bbq-chicken',
            'description' => 'Salsa barbacoa, pollo marinado, bacon y cebolla morada.',
            'price' => 15.50,
            'images' => ['pizzas/bbq_chicken.png'],
        ]);
        $bbq->ingredients()->attach(
            Ingredient::whereIn('name', ['Barbacoa', 'Mozzarella', 'Pollo', 'Bacon', 'Cebolla'])->pluck('id')
        );
    }
}
