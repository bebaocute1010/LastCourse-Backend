<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Carrier;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCondition;
use App\Models\ProductVariant;
use App\Models\User;
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
        $this->call(ShopSeeder::class);
        $this->call(WarehouseSeeder::class);
        ProductCondition::factory(20)->create();
        Image::factory(200)->create();
        User::factory(100)->create();
        Product::factory(500)->create();
        Carrier::factory(100)->create();
        Bill::factory(1000)->create();
        BillDetail::factory(5000)->create();
        ProductVariant::factory(2000)->create();
        Category::factory(100)->create();
        Cart::factory(1000)->create();
        Comment::factory(1000)->create();
    }
}
