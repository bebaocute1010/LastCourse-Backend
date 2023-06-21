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
    private $variant_keys;
    private $discount_keys;

    public function __construct()
    {
        $this->product_service = new ProductService();
        $this->uploader = new Uploader();
        $this->variant_keys = [
            "variant_names",
            "variant_images",
            "variants_item_quantity",
            "variants_item_price",
        ];
        $this->discount_keys = [
            "discount_ranges_min",
            "discount_ranges_max",
            "discount_ranges_amount"
        ];
    }

    public function updateOrCreate(CreateProductRequest $request)
    {
        $data_validated = $request->validated();
        if (!Arr::exists($data_validated, "is_variant")) {
            $data_validated = $this->removeKeysOfArray($data_validated, $this->variant_keys);
        }
        if (!Arr::exists($data_validated, "is_buy_more_discount")) {
            $data_validated = $this->removeKeysOfArray($data_validated, $this->discount_keys);
        }

        $image_ids = [];
        if (Arr::exists($data_validated, "images")) {
            foreach ($data_validated["images"] as $image) {
                $image_ids[] = $this->uploader->upload($image)->id;
            }
        }

        if (Arr::exists($data_validated, "id") && $product = $this->product_service->find($data_validated["id"])) {
            $old_image_ids = $product->image_ids;
            foreach ($old_image_ids as $id) {
                $this->uploader->delete($id);
            }
            foreach ($product->variants as $variant) {
                if ($variant->color_image_id) {
                    $this->uploader->delete($variant->color_image_id);
                }
                if ($variant->size_image_id) {
                    $this->uploader->delete($variant->size_image_id);
                }
                $variant->forceDelete();
            }
            foreach ($product->discountRanges as $discount) {
                $discount->forceDelete();
            }
        }

        Arr::forget($data_validated, "images");
        $data_validated += ["image_ids" => $image_ids, "slug" => $this->createSlug($data_validated["name"])];
        return $this->product_service->updateOrCreate($data_validated, $this->variant_keys, $this->discount_keys);
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
