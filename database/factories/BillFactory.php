<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => fake()->numberBetween(1, 100),
            "shop_id" => fake()->numberBetween(1, 20),
            "carrier_id" => fake()->numberBetween(1, 100),
            "receiver" => fake()->name(),
            "phone" => fake()->phoneNumber(),
            "address" => fake()->address(),
            "shipping_fee" => fake()->numberBetween(10000, 30000),
            "status" => fake()->numberBetween(1, 5),
            "total" => fake()->numberBetween(1000, 20000000),
            "payment_method" => fake()->numberBetween(0, 1),
        ];
    }
}
