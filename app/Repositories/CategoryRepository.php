<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function categoriesHome()
    {
        return Category::whereNotNull("image")->get();
    }

    public function all()
    {
        return Category::orderByDesc('id')->get();
    }

    public function getCategoriesInArray(array $cat_ids)
    {
        return Category::whereIn("id", $cat_ids)->get();
    }

    public function getSubCategories($parent_id)
    {
        return Category::where("parent_id", $parent_id)->select("id", "name", "image")->get();
    }
}
