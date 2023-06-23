<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Carrier;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariant;
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
        $this->call(ConditionSeeder::class);
        $this->call(ShopSeeder::class);
        Image::factory(100)->create();
        User::factory(100)->create();
        Warehouse::factory(100)->create();
        Product::factory(1000)->create();
        Carrier::factory(100)->create();
        Bill::factory(1000)->create();
        BillDetail::factory(5000)->create();
        ProductVariant::factory(5000)->create();
        Category::factory(100)->create();
    }
}
