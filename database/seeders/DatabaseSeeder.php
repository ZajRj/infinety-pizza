<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the Admin User
        if (!User::where('email', 'developer@mail.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'developer@mail.com',
                'dni' => '00000000X',
                'password' => Hash::make('developer'),
                'is_admin' => true,
                'email_verified_at'=>now()
            ]);
        }

        // 2. Call the specific seeders
        $this->call([
            CategorySeeder::class,
            IngredientSeeder::class,
            PizzaSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
