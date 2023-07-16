<?php

namespace Database\Factories;

use App\Models\Carrier;
use App\Models\Shop;
use App\Models\User;
use Faker\Provider\vi_VN\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    protected $model = \App\Models\Bill::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Person($this->faker));

        $user_ids = User::all()->pluck("id")->toArray();
        $shop_ids = Shop::all()->pluck("id")->toArray();
        $carrier_ids = Carrier::all()->pluck("id")->toArray();
        $receiver = explode(".", $this->faker->name());
        return [
            "code" => Str::upper(Str::random(16)),
            "user_id" => $this->faker->randomElement($user_ids),
            "shop_id" => $this->faker->randomElement($shop_ids),
            "carrier_id" => $this->faker->randomElement($carrier_ids),
            "receiver" => trim($receiver[1] ?? $receiver[0]),
            "phone" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
            "shipping_fee" => $this->faker->numberBetween(10000, 30000),
            "status" => $this->faker->numberBetween(1, 5),
            "total" => $this->faker->numberBetween(1000, 500000),
            "payment_method" => $this->faker->numberBetween(0, 1),
        ];
    }
}
