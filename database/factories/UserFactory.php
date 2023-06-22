<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            "username" => Str::limit(fake()->userName(), 20),
            'password' => '11111111',
            'avatar' => fake()->numberBetween(1, 100),
            'fullname' => fake()->name(),
            "gender" => fake()->numberBetween(0, 1),
            "birthday" => fake()->date(),
            'email_verified_at' => now(),
            "invite_code" => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
