<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CarrierSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(ShopSeeder::class);
        Image::factory(100)->create();
        User::factory(100)->create();
        Warehouse::factory(100)->create();
    }
}
