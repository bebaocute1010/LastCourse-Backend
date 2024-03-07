<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            [
                "name" => "Máy tính và Laptop",
                "image" => "https://down-vn.img.susercontent.com/file/sg-11134201-22100-932jnj9asliv4c_tn",
                "sub_cats" => [
                    [
                        "name" => "Phụ kiện máy tính",
                        "image" => "https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-livdc6egao7g21_tn",
                    ],
                ],
            ],
            [
                "name" => "Nhà cửa và đời sống",
                "image" => "https://down-vn.img.susercontent.com/file/5a18f18bad1e2e74774e5305708f70bf_tn",
            ],
            [
                "name" => "Nhà sách online",
                "image" => "https://down-vn.img.susercontent.com/file/a6882e15b20e5ecb22a0c87e14d1fde9_tn",
            ],
            [
                "name" => "Thời trang",
                "image" => "https://down-vn.img.susercontent.com/file/7a4423c2fa56a1274c0853663e46a0ff_tn",
                "sub_cats" => [
                    [
                        "name" => "Đồng hồ",
                        "image" => "https://down-vn.img.susercontent.com/file/9167d4c196cc8e58555decded2c6cd5c_tn",
                        "sub_cats" => [
                            [
                                "name" => "Đồng hồ nam",
                                "image" => "https://down-vn.img.susercontent.com/file/16eed7619f7d1cde9c8f48ae874dd64b_tn",
                            ],
                            [
                                "name" => "Đồng hồ nữ",
                                "image" => "https://down-vn.img.susercontent.com/file/1dee9de35807632032cc7546087abe53_tn",
                            ],
                        ],
                    ],
                    [
                        "name" => "Thời trang nam",
                        "image" => "https://down-vn.img.susercontent.com/file/cf73bce419a7a2588ee84c894d8f1729_tn",
                        "sub_cats" => [
                            [
                                "name" => "Áo sơ mi",
                                "image" => "https://down-vn.img.susercontent.com/file/vn-11134201-23030-h106chevmwov3b_tn",
                            ],
                            [
                                "name" => "Áo thun",
                                "image" => "https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lh9zceu5ysc3de_tn",
                            ],
                            [
                                "name" => "Áo Vest và Blazer",
                                "image" => "https://down-vn.img.susercontent.com/file/6d85e91f8b7e3b1a370bd056db36ff4f_tn",
                                "sub_cats" => [
                                    [
                                        "name" => "Bộ Com lê",
                                        "image" => "https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-ljc91r87kf7w8b_tn",
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        "name" => "Thời trang nữ",
                        "image" => "https://down-vn.img.susercontent.com/file/d8cff99cc60de339638d225ab7ea19a5_tn",
                        "sub_cats" => [
                            [
                                "name" => "Chân váy",
                                "image" => "https://down-vn.img.susercontent.com/file/91cb36a3d3669953ee4ec1d6e656bdcd_tn",
                            ],
                            [
                                "name" => "Quần jeans",
                                "image" => "https://down-vn.img.susercontent.com/file/17de63d6cce429b9dd78882598f2f8de_tn",
                            ],
                            [
                                "name" => "Set đồ nữ",
                                "image" => "https://down-vn.img.susercontent.com/file/d1c7a4c5085e5056d9c1218cc2aeafec_tn",
                                "sub_cats" => [
                                    [
                                        "name" => "Đồ ngủ",
                                        "image" => "https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lff5ltc3br05b4_tn",
                                    ],
                                    [
                                        "name" => "Đồ truyền thống",
                                        "image" => "https://down-vn.img.susercontent.com/file/vn-11134201-23030-vm04mevvnoov2f_tn",
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        
        $this->loadCats($cats);
    }

    private function loadCats($cats, $parent_id = null)
    {
        foreach ($cats as $cat) {
            $category = $this->updateOrCreate(["name" => $cat["name"], "parent_id" => $parent_id, "image" => $cat["image"]]);
            if (isset($cat["sub_cats"])) {
                $this->loadCats($cat["sub_cats"], $category->id);
            }
        }
    }

    private function updateOrCreate(array $data)
    {
        return Category::updateOrCreate(
            [
                "name" => $data["name"],
                "parent_id" => $data["parent_id"]
            ],
            array_merge($data, ['code' => Str::slug($data['name'])]));
    }
}
