<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Utils\Uploader;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product_service;
    private $uploader;

    public function __construct()
    {
        $this->product_service = new ProductService();
        $this->uploader = new Uploader();
    }

    public function create(CreateProductRequest $request)
    {
        $data_validated = $request->validated();
        if (!Arr::exists($data_validated, "is_variant")) {
            $data_validated = $this->removeKeysOfArray($data_validated, [
                "variant_names",
                "variant_images",
                "variants_item_quantity",
                "variants_item_price",
            ]);
        }
        if (!Arr::exists($data_validated, "is_buy_more_discount")) {
            $data_validated = $this->removeKeysOfArray($data_validated, [
                "discount_ranges_min",
                "discount_ranges_max",
                "discount_ranges_amount"
            ]);
        }
        $image_ids = [];
        if (Arr::exists($data_validated, "images")) {
            foreach ($data_validated["images"] as $image) {
                $image_ids[] = $this->uploader->upload($image)->id;
            }
        }
        Arr::forget($data_validated, "images");
        $data_validated += ["image_ids" => $image_ids, "slug" => $this->createSlug($data_validated["name"])];
        return $this->product_service->create($data_validated);
    }

    private function createSlug($name)
    {
        do {
            $slug = Str::slug($name . " " . Str::random(10), "-");
        } while (Product::where("slug", $slug)->first());
        return $slug;
    }

    public function removeKeysOfArray(array $data, array $keys)
    {
        foreach ($keys as $key) {
            if (Arr::exists($data, $key)) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
