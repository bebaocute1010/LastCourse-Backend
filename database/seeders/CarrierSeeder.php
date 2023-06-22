<?php

namespace Database\Seeders;

use App\Models\Carrier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            Carrier::updateOrCreate([
                "code" => "DVVC_" . $i,
                "name" => "Đơn vị vận chuyển " . $i,
                "price" => 15000
            ]);
        }
    }
}
