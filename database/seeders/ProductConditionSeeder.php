<?php

namespace Database\Seeders;

use App\Models\ProductCondition;
use Illuminate\Database\Seeder;

class ProductConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Hàng mới", "Hàng 99%", "Hàng đã qua sử dụng"];
        foreach ($names as $name) {
            ProductCondition::create(["name" => $name]);
        }
    }
}
