<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getCategoriesLevel1()
    {
        return Category::whereNull("parent_id")->get();
    }

    public function getCategoriesLevel2($parent_id)
    {
        return Category::where("parent_id", $parent_id)->get();
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
