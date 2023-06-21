<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category::create([
            "name" => "Category cha",
        ]);
        for ($i = 1; $i < 10; $i++) {
            Category::updateOrCreate([
                "name" => "Category con " . $i,
                "parent_id" => 0
            ]);
        }
    }
}
