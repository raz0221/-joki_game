<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run()
    {
        Game::create([
            'name' => 'Mobile Legends',
            'description' => 'Jasa joki rank Mobile Legends dari Warrior hingga Mythic',
            'base_price' => 20000,
        ]);

        Game::create([
            'name' => 'PUBG Mobile',
            'description' => 'Jasa joki rank PUBG Mobile dari Bronze hingga Conqueror',
            'base_price' => 25000,
        ]);

        Game::create([
            'name' => 'Free Fire',
            'description' => 'Jasa joki rank Free Fire dari Bronze hingga Heroic',
            'base_price' => 15000,
        ]);
    }
}
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            GameSeeder::class,
            UserSeeder::class,
        ]);
    }
}