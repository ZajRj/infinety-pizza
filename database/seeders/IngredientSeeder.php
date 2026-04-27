<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\IngredientCategory;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Quesos' => [
                'Mozzarella',
                'Parmesano',
                'Gorgonzola',
                'Cheddar',
            ],
            'Carnes' => [
                'Pepperoni',
                'Jamón York',
                'Bacon',
                'Pollo',
                'Carne Picada',
            ],
            'Vegetales' => [
                'Champiñones',
                'Pimientos',
                'Cebolla',
                'Aceitunas Negras',
                'Maíz',
                'Piña',
                'Albahaca',
            ],
            'Salsas' => [
                'Tomate',
                'Barbacoa',
                'Carbonara',
                'Pesto',
            ],
        ];

        foreach ($data as $categoryName => $ingredients) {
            $category = IngredientCategory::create([
                'name' => $categoryName,
                'description' => "Ingredientes del tipo {$categoryName}",
            ]);

            foreach ($ingredients as $name) {
                Ingredient::create([
                    'ingredient_category_id' => $category->id,
                    'name' => $name,
                    'description' => "Delicioso {$name} fresco.",
                ]);
            }
        }
    }
}
