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
        $avatars = [
            "https://vapa.vn/wp-content/uploads/2022/12/anh-den-ngau.jpeg",
            "https://pcilaocai.vn/wp-content/uploads/2023/04/top-36-anh-dai-dien-dep-cute-dang-yeu-nhat-qua-dat-39.jpg",
            "https://khoinguonsangtao.vn/wp-content/uploads/2022/05/anh-avatar-dep-ngau-hinh-dai-dien.jpg",
            "https://img2.thuthuatphanmem.vn/uploads/2018/11/30/anh-dai-dien-anime-dep_104204759.jpg",
            "https://freenice.net/wp-content/uploads/2021/08/hinh-anh-avatar-dep.jpg",
            "https://hinhnen4k.com/wp-content/uploads/2023/03/anh-dai-dien-doi-1.jpg",
            "https://toigingiuvedep.vn/wp-content/uploads/2021/01/avatar-dep-cute.jpg",
            "https://i0.wp.com/top10dienbien.com/wp-content/uploads/2022/10/avatar-cute-11.jpg?w=960&ssl=1",
            "https://taimienphi.vn/tmp/cf/aut/UCJh-I6e5-pGG8-5NjT-O83K-mmJy-eZta-9nqH-anh-dai-dien-dep-cute-1.jpg",
            "https://top10kontum.com/wp-content/uploads/2022/10/anh-dai-dien-zalo-y-nghia-2.jpg",
        ];
        $this->faker->addProvider(new Person($this->faker));
        $fullname = explode(".", $this->faker->name());
        return [
            "email" => $this->faker->unique()->safeEmail(),
            "username" => Str::limit($this->faker->unique()->userName(), 20, ""),
            "password" => "11111111",
            "avatar" => $this->faker->randomElement($avatars),
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
