<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin HAFTAP',
            'email' => 'admin@haftapjoki.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Joki user
        User::create([
            'name' => 'Joki Profesional',
            'email' => 'joki@haftapjoki.com',
            'password' => Hash::make('password'),
            'role' => 'joki',
            'phone' => '081234567891',
            'game_specialty' => 'Mobile Legends, PUBG, Free Fire',
        ]);

        // Customer user
        User::create([
            'name' => 'Customer Contoh',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081234567892',
        ]);

        // Generate additional users
        User::factory(10)->create();
    }
}