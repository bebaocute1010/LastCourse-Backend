<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getCategoriesInArray(array $cat_ids)
    {
        return Category::whereIn("id", $cat_ids)->get();
    }

    public function getSubCategories($parent_id)
    {
        return Category::where("parent_id", $parent_id)->select("id", "name")->get();
    }

    public function searchCategories(array $keywords = [])
    {
        $categories = Category::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere("name", "like", "%" . $keyword . "%");
            }
        })
            ->get()
            ->sortByDesc(function ($category) use ($keywords) {
                $name = strtolower($category->name);
                $count = 0;

                foreach ($keywords as $keyword) {
                    if (strpos($name, strtolower($keyword)) !== false) {
                        $count++;
                    }
                }

                return $count;
            });
        return $categories;
    }
}
