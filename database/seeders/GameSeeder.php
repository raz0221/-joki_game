<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game; // Pastikan import model
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'name' => 'Mobile Legends',
                'slug' => Str::slug('Mobile Legends'),
                'description' => 'Jasa joki rank Mobile Legends',
                'base_price' => 20000
            ],
            [
                'name' => 'PUBG Mobile',
                'slug' => Str::slug('PUBG Mobile'),
                'description' => 'Jasa joki rank PUBG Mobile',
                'base_price' => 25000
            ],
            [
                'name' => 'Free Fire',
                'slug' => Str::slug('Free Fire'),
                'description' => 'Jasa joki rank Free Fire',
                'base_price' => 15000
            ],
        ];

        foreach ($games as $game) {
            // Gunakan sintaks yang benar
            Game::create($game);
        }
    }
}