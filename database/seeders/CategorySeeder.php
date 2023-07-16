<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

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
                "sub_cats" => [
                    [
                        "name" => "Phụ kiện máy tính",
                    ],
                ],
            ],
            [
                "name" => "Nhà cửa và đời sống",
            ],
            [
                "name" => "Nhà sách online",
            ],
            [
                "name" => "Thời trang",
                "sub_cats" => [
                    [
                        "name" => "Đồng hồ",
                        "sub_cats" => [
                            [
                                "name" => "Đồng hồ nam",
                            ],
                            [
                                "name" => "Đồng hồ nữ",
                            ],
                        ],
                    ],
                    [
                        "name" => "Thời trang nam",
                        "sub_cats" => [
                            [
                                "name" => "Áo sơ mi",
                            ],
                            [
                                "name" => "Áo thun",
                            ],
                            [
                                "name" => "Áo Vest và Blazer",
                                "sub_cats" => [
                                    [
                                        "name" => "Bộ Com lê"
                                    ]
                                ]
                            ],
                        ],
                    ],
                    [
                        "name" => "Thời trang nữ",
                        "sub_cats" => [
                            [
                                "name" => "Chân váy",
                            ],
                            [
                                "name" => "Quần jeans",
                            ],
                            [
                                "name" => "Set đồ nữ",
                                "sub_cats" => [
                                    [
                                        "name" => "Đồ ngủ",
                                    ],
                                    [
                                        "name" => "Đồ truyền thống"
                                    ]
                                ]
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
            $category = $this->updateOrCreate(["name" => $cat["name"], "parent_id" => $parent_id]);
            if (isset($cat["sub_cats"])) {
                $this->loadCats($cat["sub_cats"], $category->id);
            }
        }
    }

    private function updateOrCreate(array $data)
    {
        return Category::updateOrCreate(["name" => $data["name"], "parent_id" => $data["parent_id"]], $data);
    }
}
