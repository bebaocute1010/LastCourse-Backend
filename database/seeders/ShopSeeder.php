<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            Shop::updateOrCreate([
                "user_id" => $i,
                "name" => "SHOP " . $i,
                "avatar" => $i,
                "created_at" => now(),
            ]);
        }
    }
}
