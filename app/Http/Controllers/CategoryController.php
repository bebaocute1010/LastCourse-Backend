<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category_service;

    public function __construct()
    {
        $this->category_service = new CategoryService();
    }

    public function getCategoriesLevel1()
    {
        return CategoryResource::collection($this->category_service->getCategoriesLevel1());
    }

    public function getCategoriesLevel2(Request $request)
    {
        return CategoryResource::collection($this->category_service->getCategoriesLevel2($request->parent_id));
    }

    public function searchCategories(Request $request)
    {
        return CategoryResource::collection($this->category_service->searchCategories($request->search));
    }
}
