<?php

namespace Database\Seeders;

use App\Models\Carrier;
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
        $names = [
            ["name" => "Giao hàng nhanh", "code" => "YS7SUT01QG", "price" => "16507"],
            ["name" => "Giao hàng tiết kiệm", "code" => "62M00NXKMO", "price" => "19394"],
            ["name" => "J&T Express", "code" => "DBPY2W5V7E", "price" => "19005"],
            ["name" => "Vietnam Post", "code" => "1OJ03SZ9FT", "price" => "19781"],
            ["name" => "Viettel Post", "code" => "N4AP8Q4IWP", "price" => "17951"],
            ["name" => "GrabExpress", "code" => "AW4JZ72KYI", "price" => "19582"],
            ["name" => "Xpress Instant", "code" => "9JI6BI8EUE", "price" => "15464"],
            ["name" => "Ninja Van", "code" => "0S8YZ5VVRF", "price" => "15464"],
            ["name" => "Shopee Xpress", "code" => "5X7ED0VH2K", "price" => "18646"],
            ["name" => "beDelivery", "code" => "D2V5NCVQSZ", "price" => "15697"],
            ["name" => "AhaMove", "code" => "C5MK726YXW", "price" => "17252"],
        ];

        foreach ($names as $name) {
            Carrier::updateOrCreate($name, $name);
        }
    }
}
