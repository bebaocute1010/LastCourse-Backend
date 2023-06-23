<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $shop_id = fake()->numberBetween(1, 50);
        $name = fake()->sentence(4);
        return [
            "shop_id" => $shop_id,
            "cat_id" => fake()->numberBetween(1, 10),
            "condition_id" => fake()->numberBetween(1, 50),
            "warehouse_id" => $shop_id,
            "carrier_id" => fake()->numberBetween(1, 100),
            "image_ids" => [fake()->numberBetween(1, 100), fake()->numberBetween(1, 100), fake()->numberBetween(1, 100)],
            "is_variant" => null,
            "is_pre_order" => null,
            "is_buy_more_discount" => null,
            "is_hidden" => null,
            "name" => $name,
            "slug" => Str::slug($name . " " . Str::random(10)),
            "detail" => fake()->sentence(100),
            "brand" => fake()->name(),
            "inventory" => fake()->numberBetween(1, 99999),
            "sold" => fake()->numberBetween(0, 10000),
            "price" => fake()->numberBetween(1000, 5000000),
            "rating" => fake()->randomFloat(1,1,5),
            "weight" => fake()->numberBetween(1, 50),
            "length" => fake()->numberBetween(1, 200),
            "width" => fake()->numberBetween(1, 200),
            "height" => fake()->numberBetween(1, 200),
        ];
    }
}
