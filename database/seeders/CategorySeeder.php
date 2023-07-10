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
                "name" => "Thời Trang Nữ",
                "sub_cats" => [
                    "Quần",
                    "Quần đùi",
                    "Chân váy",
                    "Quần jeans",
                    "Đầm/Váy",
                    "Váy cưới",
                ],
            ],
            [
                "name" => "Thời Trang Nam",
                "sub_cats" => [
                    "Áo Khoác",
                    "Áo Vest và Blazer",
                    "Áo Hoodie, Áo Len & Áo Nỉ",
                    "Quần Jeans",
                    "Quần Dài/Quần Âu",
                    "Quần Short",
                ],
            ],
            [
                "name" => "Đồng Hồ",
                "sub_cats" => [
                    "Đồng Hồ Nam",
                    "Đồng Hồ Nữ",
                    "Bộ Đồng Hồ & Đồng Hồ Cặp",
                    "Đồng Hồ Trẻ Em",
                    "Phụ Kiện Đồng Hồ",
                ],
            ],
            [
                "name" => "Giày Dép",
                "sub_cats" => [
                    "Bốt",
                    "Giày Thể Thao/ Sneakers",
                    "Giày Sục",
                ],
            ],
            [
                "name" => "Máy Tính & Laptop",
                "sub_cats" => [
                    "Máy Tính Bàn",
                    "Màn Hình",
                    "Linh Kiện Máy Tính",
                    "Thiết Bị Lưu Trữ",
                ],
            ],
        ];

        $id = 1;
        $cat_lv1_id = 1;
        foreach ($cats as $cat) {
            $category = $this->updateOrCreate(["name" => $cat["name"], "parent_id" => null]);
            foreach ($cat["sub_cats"] as $sub_cat) {
                $this->updateOrCreate(["name" => $sub_cat, "parent_id" => $category->id]);
            }
        }
    }

    private function updateOrCreate(array $data)
    {
        return Category::updateOrCreate(["name" => $data["name"], "parent_id" => $data["parent_id"]], $data);
    }
}
