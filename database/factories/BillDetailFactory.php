<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillDetail>
 */
class BillDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $bill_ids = Bill::all()->pluck("id")->toArray();
        // $product_ids = Product::all()->pluck("id")->toArray();
        return [
            "bill_id" => fake()->numberBetween(1,1000),
            "product_id" => fake()->numberBetween(1, 320),
            "quantity" => fake()->numberBetween(1, 50),
            "price" => fake()->numberBetween(10000, 30000000),
        ];
    }
}
