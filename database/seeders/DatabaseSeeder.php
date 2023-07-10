<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Product;
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
        $this->call(CategorySeeder::class);
        $this->call(CarrierSeeder::class);
        $this->call(ProductConditionSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(WarehouseSeeder::class);
        Product::factory(320)->create();
        User::factory(50)->create();
        Cart::factory(1000)->create();
        Bill::factory(1000)->create();
        BillDetail::factory(5000)->create();
        Comment::factory(5000)->create();
        // ProductVariant::factory(2000)->create();
    }
}
