<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Avatar default
        Image::create(["url" => "https://nhanvietluanvan.com/wp-content/uploads/2023/05/c6e56503cfdd87da299f72dc416023d4-736x620.jpg"]);
        //Banner defalt
        Image::create(["url" => "https://www.mub.eps.manchester.ac.uk/thebeam/wp-content/themes/uom-theme/assets/images/default-banner.jpg"]);

        //Avatars factory
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

        $comment_images = [
            "https://storage.googleapis.com/cdn.nhanh.vn/store/25618/artCT/87825/ao_thun_unisex_nam_1.jpg",
            "https://storage.googleapis.com/cdn.nhanh.vn/store/25618/artCT/87825/ao_thun_unisex_nam_2.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVcAk-mybOPU1Zey2t_UC9LIrZ31lb2-oR-lSlQ7eN2UTDuCPaes_FohAFr_12rEnQSCU&usqp=CAU",
            "https://cf.shopee.vn/file/077c826170aaf376def0aeca0ff6061a",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrb88NQQbFpMb9P1GhlxZ-w23-fK-hLiEBljEFoUcKdYHUtEoTVKlVb1xYljl_3Zsut_I&usqp=CAU",
            "https://salt.tikicdn.com/cache/w1200/ts/product/cb/d2/a0/c2bd00e68910e5162272f0dc2ef165f1.jpg",
            "https://bizweb.dktcdn.net/100/386/478/products/6062613d-70ad-4f61-918f-1f14d1d3a48e.jpg?v=1648116718603",
            "https://shop.dazlinn.com/wp-content/uploads/2022/08/ao-thun-fromm-r-ng-n-ao-thun-ki-u-n-han-qu-c-v-i-cotton-thoang-mat-ao-phong.jpg",
            "https://cdn.gumac.vn/image/01/onpage/bai-39/ao-phong-nu-mau-vang270320191106274172.jpg",
            "https://ghp-garment.com/wp-content/uploads/2022/09/ao-phong-nu-form-rong-famous-in-hinh-gau-ao-thun-nu-cotton-oversize-tay-ngan-co-tron-1-scaled.jpg",
        ];

        foreach ($avatars as $avatar) {
            Image::create(["url" => $avatar]);
        }

        foreach ($comment_images as $url) {
            Image::create(["url" => $url]);
        }

        for ($i = 1; $i <= 960; $i++) {
            Image::create(["url" => env("APP_URL") . "/storage/ImagesSeeder/" . $i . ".jpg"]);
        }
    }
}
