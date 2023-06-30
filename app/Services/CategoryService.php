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

    public function getCategoriesLevel1()
    {
        return $this->category_repository->getCategoriesLevel1();
    }

    public function getCategoriesLevel2($parent_id = null)
    {
        if (!$parent_id) {
            return collect([]);
        }
        return $this->category_repository->getCategoriesLevel2($parent_id);
    }

    public function searchCategories(string $search)
    {
        $keywords = $search ? explode(" ", $search) : [];
        return $this->category_repository->searchCategories($keywords);
    }
}
