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

    public function getCategories(string $search)
    {
        $keywords = $search ? explode(" ", $search) : [];
        return $this->category_repository->getCategories($keywords);
    }
}
