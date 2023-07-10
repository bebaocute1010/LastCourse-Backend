<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Nette\Utils\Random;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locates = [
            "An Giang",
            "Kon Tum",
            "Bà Rịa – Vũng Tàu",
            "Lai Châu",
            "Bắc Giang",
            "Lâm Đồng",
            "Bắc Kạn",
            "Lạng Sơn",
            "Bạc Liêu",
            "Lào Cai",
            "Bắc Ninh",
            "Long An",
            "Bến Tre",
            "Nam Định",
            "Bình Định",
            "Nghệ An",
            "Bình Dương",
            "Ninh Bình",
            "Bình Phước",
            "Ninh Thuận",
            "Bình Thuận",
            "Phú Thọ",
            "Cà Mau",
            "Phú Yên",
            "Cần Thơ",
            "Quảng Bình",
            "Cao Bằng",
            "Quảng Nam",
            "Đà Nẵng",
            "Quảng Ngãi",
            "Đắk Lắk",
            "Quảng Ninh",
            "Đắk Nông",
            "Quảng Trị",
            "Điện Biên",
            "Sóc Trăng",
            "Đồng Nai",
            "Sơn La",
            "Đồng Tháp",
            "Tây Ninh",
            "Gia Lai",
            "Thái Bình",
            "Hà Giang",
            "Thái Nguyên",
            "Hà Nam",
            "Thanh Hóa",
            "Hà Nội",
            "Thừa Thiên Huế",
            "Hà Tĩnh",
            "Tiền Giang",
            "Hải Dương",
            "TP Hồ Chí Minh",
            "Hải Phòng",
            "Trà Vinh",
            "Hậu Giang",
            "Tuyên Quang",
            "Hòa Bình",
            "Vĩnh Long",
            "Hưng Yên",
            "Vĩnh Phúc",
            "Khánh Hòa",
            "Yên Bái",
            "Kiên Giang",
        ];

        for ($i = 1; $i <= 20; $i++) {
            Shop::updateOrCreate([
                "user_id" => $i,
                "carrier_id" => random_int(1, 11),
                "name" => "SHOP " . $i,
                "email" => "shop" . $i . "@gmail.com",
                "avatar" => Image::DEFAULT_AVATAR_ID,
                "banner" => Image::DEFAULT_BANNER_ID,
                "locate" => Arr::random($locates),
                "created_at" => now(),
            ]);
        }
    }
}
