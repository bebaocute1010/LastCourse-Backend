<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "bill_id" => fake()->numberBetween(1, 1000),
            "product_id" => fake()->numberBetween(1, 100),
            "user_id" => fake()->numberBetween(1, 100),
            "image_ids" => [fake()->numberBetween(1, 100), fake()->numberBetween(1, 100), fake()->numberBetween(1, 100)],
            "content" => fake()->sentence(70),
            "rating" => fake()->numberBetween(1, 5),
        ];
    }
}
