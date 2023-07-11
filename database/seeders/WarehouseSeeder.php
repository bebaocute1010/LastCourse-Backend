<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            Warehouse::updateOrCreate([
                "shop_id" => $i,
                "name" => "Warehouse " . $i,
                "address" => "Số " . $i . ", Thanh Xuân - Hà Nội",
            ]);
        }
    }
}
