<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductVariantService;
use App\Utils\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductVariantController extends Controller
{
    private $product_variant_service;
    private $uploader;

    public function __construct()
    {
        $this->product_variant_service = new ProductVariantService();
        $this->uploader = new Uploader();
    }

    public function create(array $data)
    {
        $colors = $data["variant_names"][0] ?? null;
        $sizes = $data["variant_names"][1] ?? null;
        $image_colors = $this->getArrayImages($data["variant_images"][0]);
        $image_sizes = $this->getArrayImages($data["variant_images"][1]);
        Arr::forget($data, "variant_images");
        Arr::forget($data, "variant_names");
        $data["image_colors"] = $image_colors;
        $data["image_sizes"] = $image_sizes;
        $data["colors"] = $colors;
        $data["sizes"] = $sizes;
        return $this->product_variant_service->create($data);
    }

    private function getArrayImages($images)
    {
        $image_ids = [];
        for ($i = 0; $i <= max(array_keys($images)); $i++) {
            if (isset($images[$i])) {
                $image_ids[$i] = $this->uploader->upload($images[$i])->id;
            }
        }
        return $image_ids;
    }
}
