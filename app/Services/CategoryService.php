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

    public function categoriesHome()
    {
        return $this->category_repository->categoriesHome();
    }

    public function all()
    {
        return $this->category_repository->all();
    }

    public function getCategoriesInArray(array $cat_ids)
    {
        return $this->category_repository->getCategoriesInArray($cat_ids);
    }

    public function getCategoryFamily($category)
    {
        $categories = [$this->getSubCategories($category->id)] ?? [];
        $categories_selected = [];
        while ($category != null) {
            array_unshift($categories_selected, $category->id);
            array_unshift($categories, $this->getSubCategories($category->parent_id));
            $category = $category->parent;
        }
        return ["categories" => $categories, "categories_selected" => $categories_selected];
    }

    public function getSubCategories($cat_id)
    {
        return $this->category_repository->getSubCategories($cat_id);
    }
}
