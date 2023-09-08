<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
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

        $warehouses = [
            "46 Tran Hung Dao,Hanoi",
            "229 Luy Ban Bich St. Hoa Thanh Ward,Binh Thuan",
            "2 Nguyen Thai Son Street   Ward 3,Hanoi",
            "678 Truong Chinh St. Ward 15,Ho Chi Minh City",
            "378 Vinh Son Ward 3,Hue",
            "98 Nguyen Dinh Chieu Dist1,Khanh Hoa",
        ];

        for ($i = 1; $i <= 20; $i++) {
            Shop::updateOrCreate(
                ["email" => "shop" . $i . "@gmail.com"],
                [
                    "user_id" => $i,
                    "carrier_id" => random_int(1, 11),
                    "name" => "SHOP " . $i,
                    "slug" => Str::slug("SHOP " . $i . " " . Str::random(10)),
                    "email" => "shop" . $i . "@gmail.com",
                    "warehouse" => Arr::random($warehouses),
                    "avatar" => Arr::random($avatars),
                    "banner" => Shop::BANNER_DEFAULT,
                    "locate" => Arr::random($locates),
                    "created_at" => now(),
                ]);
        }
    }
}
