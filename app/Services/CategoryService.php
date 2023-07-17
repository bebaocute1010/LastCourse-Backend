<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private $category_repository;

    public function __construct()
    {
        $this->category_repository = new CategoryRepository();
    }

    public function getCategoryFamily($category)
    {
        $categories = [$this->getSubCategories($category->id)] ?? [];
        $categories_selected = [];
        while ($category != null) {
            array_unshift($categories_selected, $category->id);
            array_unshift($categories, $this->getCategories($category->parent_id));
            $category = $category->parent;
        }
        // $categories = collect($categories)->map(function ($category) {
        //     $group_categories
        // })
        return ["categories" => $categories, "categories_selected" => $categories_selected];
    }

    public function getSubCategories($cat_id)
    {
        return $this->category_repository->getCategories($cat_id);
    }

    public function getCategories($parent_id = null)
    {
        return $this->category_repository->getCategories($parent_id);
    }

    public function searchCategories($search)
    {
        $keywords = $search ? str_split($search) : [];
        return $this->category_repository->searchCategories($keywords);
    }
}
