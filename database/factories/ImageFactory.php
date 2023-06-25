<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $urls = [
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
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCrTUnS4Uud5U14cmmuPU9RWteC4uMfilokQ&usqp=CAU",
            "https://cf.shopee.vn/file/08215a753d8f75137d16a6e262801dec",
            "https://bizweb.dktcdn.net/thumb/large/100/464/038/products/sg-11134201-22100-54vgw0jcediv18-1665156311614.jpg?v=1669274787437",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRp-r7dAibGM1dBuKtxXq6dRnAMpsPj0DBrTe94RK2K0QPHS4rE7GPCzMQ0GhZxmfgQZA&usqp=CAU",
            "https://bizweb.dktcdn.net/thumb/1024x1024/100/119/564/products/ao-thun-nu-han-quoc-f2075.jpg",
            "https://i0.wp.com/pt2000.com.vn/wp-content/uploads/2018/09/AP-2543.jpg?ssl=1",
            "https://cf.shopee.vn/file/fece5a245d542b4ccac50c9769b45abe",
            "https://cf.shopee.vn/file/d2f4bdc15543de7c209b2e2aadab4a6a",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGdQN8OpS0Z2m0uSw7osg_mB3D9brpbA640TqbhlPX2B-mMCkMRXg3y56pQgZDV-0bXjw&usqp=CAU",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxFI63-FWRDJC2YyWw45KNqcW1XPSP9BSIUQ&usqp=CAU",
            "https://static.sonkimfashion.vn/static/file/image/jockey/jockey-giay-jockey-style-0414-unisex-trang-phoi-do-1_b698d68553e64699917fdb71eec5cedf_grande.jpg",
            "https://wisestyle.vn/static/contents/posts/thoi-trang-unisex-2-63-6312eb2584302.jpg",
            "https://img.nhabanhang.com/sp/f/160008/quan-short-double-v-uni-quan-short-2v-nam-nu-the-thao-form-rong-vai-thun-co-dan-tap-gym-mau-den-ca-tinh-valu-store-52.jpg",
            "https://sayhi.vn/blog/wp-content/uploads/2019/09/9-min-10.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFyg-5h979LwLBa4gg2Qs04Ou5X1-e79n7Ww&usqp=CAU",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7UtXuV-tnGJ0stxR5oRdYtdYzo2-7jyz2vw&usqp=CAU",
            "https://momoshop.com.vn/wp-content/uploads/2020/04/unisex-la-gi-3-4-1.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9lkmcZo49W5BESl9cDN0cJcOgj2yWK4jDcbNKkbCRrWaVK2LP6cx8m6GCi5B6FmOileM&usqp=CAU",
            "https://xuongquanjean.com/public/img/product/800x800/5BqNse_quan-kaki-tui-hop-4-tui-1.png",
            "https://damvay.com.vn/wp-content/uploads/2022/12/mua-dam-vay-dep-1_1f81ca3dd8c24aa9b4d3b123b4d0f67a_grande-1.jpg",
            "https://pos.nvncdn.net/312d68-57499/art/artCT/20210120_dy4cQVwT8PDqBQsfEhSyShCt.jpg",
            "https://dongphucvina.vn/wp-content/uploads/2022/08/chat-lieu-vai-may-chan-vay.jpg",
            "https://1.bp.blogspot.com/-AMp9G9i7jUU/X_kZ3D5wQQI/AAAAAAAAAdI/tV14tIIx-TsjlgCHlVvs3plmuWT6GkK5gCNcBGAsYHQ/s16000/chan-vay-xoe.jpg",
        ];
        return [
            "url" => fake()->randomElement($urls)
        ];
    }
}
