<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Juan Perez',
                'email' => 'juan@example.com',
                'dni' => '11111111A',
            ],
            [
                'name' => 'Maria Rodriguez',
                'email' => 'maria@example.com',
                'dni' => '22222222B',
            ],
            [
                'name' => 'Carlos Gomez',
                'email' => 'carlos@example.com',
                'dni' => '33333333C',
            ],
            [
                'name' => 'Ana Martinez',
                'email' => 'ana@example.com',
                'dni' => '44444444D',
            ],
            [
                'name' => 'Test Customer',
                'email' => 'customer@example.com',
                'dni' => '55555555E',
            ],
        ];

        foreach ($customers as $customer) {
            User::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'dni' => $customer['dni'],
                'password' => Hash::make('password'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]);
        }
    }
}
