<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Utils\Uploader;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category_service;
    private $uploader;

    public function __construct()
    {
        $this->category_service = new CategoryService();
        $this->uploader = new Uploader();
    }

    public function getCategories(Request $request)
    {
        return CategoryResource::collection($this->category_service->getSubCategories($request->parent_id));
    }

    public function categoriesHome()
    {
        return CategoryResource::collection($this->category_service->categoriesHome());
    }

    public function all()
    {
        return CategoryResource::collection($this->category_service->all());
    }

    public function show(Request $request)
    {
        return new CategoryResource(Category::find($request->id));
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $data["image"] = $this->uploader->upload($request->file("image"));
        return Category::create($data);
    }

    public function update(UpdateCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->file("image")) {
            $data["image"] = $this->uploader->upload($request->file("image"));
        } else {
            unset($data["image"]);
        }
        $category = Category::find($request->id);
        if ($category) {
            return $category->update($data);
        }
        return response(["message" => "not found"]);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            return $category->delete();
        }
        return response(["message" => "not found"], 404);
    }
}
