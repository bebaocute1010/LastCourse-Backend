<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "product_id" => fake()->numberBetween(1,100),
            "color" => fake()->randomElement(["Đỏ", "Vàng", "Xanh", "Đen", "Trắng", "Tím"]),
            "color_image_id" => fake()->numberBetween(1, 100),
            "size" => fake()->randomElement(["S", "M", "L", "XL", "XXL", "XXXL"]),
            "quantity" => fake()->numberBetween(0, 2000),
            "price" => fake()->numberBetween(1000, 500000),
        ];
    }
}
