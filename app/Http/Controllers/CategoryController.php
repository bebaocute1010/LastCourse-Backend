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

    public function getCategories(Request $request)
    {
        return CategoryResource::collection($this->category_service->getCategories($request->search));
    }
}
