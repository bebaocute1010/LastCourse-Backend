<?php

namespace App\Services;

use App\Repositories\ProductVariantRepository;
use App\Utils\Uploader;
use Illuminate\Support\Arr;

class ProductVariantService
{
    private $product_variant_repository;
    private $uploader;

    public function __construct()
    {
        $this->product_variant_repository = new ProductVariantRepository();
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

        $variants = [];
        for ($i = 0; $i <= max(array_keys($data["colors"])); $i++) {
            for ($j = 0; $j <= max(array_keys($data["sizes"])); $j++) {
                $data_create = [
                    "product_id" => $data["product_id"],
                    "color" => $data["colors"][$i],
                    "color_image_id" => $data["image_colors"][$i] ?? null,
                    "size" => $data["sizes"][$j],
                    "size_image_id" => $data["image_sizes"][$j] ?? null,
                    "quantity" => $data["variants_item_quantity"][$i][$j],
                    "price" => $data["variants_item_price"][$i][$j],
                ];
                $variants[] = $this->product_variant_repository->create($data_create);
            }
        }
        return $variants;
    }

    private function getArrayImages($images)
    {
        $image_ids = [];
        for ($i = 0; $i <= max(array_keys($images)); $i++) {
            if (isset($images[$i])) {
                if ($image = $this->uploader->upload($images[$i])) {
                    $image_ids[$i] = $image->id;
                } else {
                    info("upload eror");
                    continue;
                }
            }
        }
        return $image_ids;
    }
}
