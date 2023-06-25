<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Nette\Utils\Random;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locates = ["Hà Nội, TP.HCM", "Đà Nẵng", "Điện Biên", "Lai Châu", "Ninh Bình", "Hải Phòng", "Quảng Ninh"];
        for ($i = 1; $i <= 100; $i++) {
            Shop::updateOrCreate([
                "user_id" => $i,
                "carrier_id" => fake()->numberBetween(1, 10),
                "name" => "SHOP " . $i,
                "avatar" => $i,
                "banner" => random_int(1, 100),
                "locate" => Arr::random($locates),
                "created_at" => now(),
            ]);
        }
    }
}
