<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = User::all()->pluck("id")->toArray();
        $product_ids = Product::all()->pluck("id")->toArray();
        return [
            "user_id" => fake()->randomElement($user_ids),
            "product_id" => fake()->randomElement($product_ids),
            "quantity" => fake()->numberBetween(0, 100),
        ];
    }
}
