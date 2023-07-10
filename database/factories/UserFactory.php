<?php

namespace Database\Factories;

use Faker\Provider\vi_VN\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $this->faker->addProvider(new Person($this->faker));
        $fullname = explode(".", $this->faker->name());
        return [
            "email" => $this->faker->unique()->safeEmail(),
            "username" => Str::limit($this->faker->unique()->userName(), 20, ""),
            "password" => "11111111",
            "avatar" => $this->faker->numberBetween(3, 12),
            "fullname" => trim($fullname[1] ?? $fullname[0]),
            "gender" => $this->faker->numberBetween(0, 1),
            "birthday" => $this->faker->date(),
            "email_verified_at" => now(),
            "invite_code" => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                "email_verified_at" => null,
            ];
        });
    }
}
