<?php

namespace Database\Factories;

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
        return [
            "bill_id" => fake()->numberBetween(1,1000),
            "product_id" => fake()->numberBetween(1,1000),
            "quantity" => fake()->numberBetween(1,50),
            "price" => fake()->numberBetween(10000, 30000000),
        ];
    }
}
