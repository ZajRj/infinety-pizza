<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Tradicionales',
                'description' => 'Las pizzas de toda la vida, con ingredientes frescos y el sabor de siempre.',
            ],
            [
                'name' => 'Premium',
                'description' => 'Recetas gourmet con ingredientes seleccionados para los paladares más exigentes.',
            ],
            [
                'name' => 'Vegetarianas',
                'description' => 'Deliciosas opciones sin carne, cargadas de vegetales frescos.',
            ],
            [
                'name' => 'Especiales',
                'description' => 'Combinaciones únicas creadas por nuestros maestros pizzeros.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }
    }
}
