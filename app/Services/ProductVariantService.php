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
        $image_colors = $this->getArrayImages($data["variant_images"][0] ?? null);
        $image_sizes = $this->getArrayImages($data["variant_images"][1] ?? null);
        Arr::forget($data, "variant_images");
        Arr::forget($data, "variant_names");
        $data["image_colors"] = $image_colors;
        $data["image_sizes"] = $image_sizes;
        $data["colors"] = $colors;
        $data["sizes"] = $sizes;
        $variants = [];

        if ($data["colors"]) {
            $color_loop_num = array_keys($data["colors"]);
        }
        if ($data["sizes"]) {
            $size_loop_num = array_keys($data["sizes"]);
        }
        $array_first_loop = isset($color_loop_num) ? $data["colors"] : $data["sizes"];

        for ($i = 0; $i <= max(array_keys($array_first_loop)); $i++) {
            if (isset($color_loop_num) && isset($size_loop_num)) {
                for ($j = 0; $j <= max(array_keys($data["sizes"])); $j++) {
                    $data_create = [
                        "product_id" => $data["product_id"],
                        "color" => $data["colors"][$i],
                        "color_image_id" => $data["image_colors"][$i] ?? null,
                        "size" => $data["sizes"][$j],
                        "size_image_id" => $data["image_sizes"][$j] ?? null,
                        "quantity" => $data["variants_item_quantity"][$i][$j] ?? 0,
                        "price" => $data["variants_item_price"][$i][$j] ?? 0,
                    ];
                    $variants[] = $this->product_variant_repository->create($data_create);
                }
            } else if (!isset($color_loop_num)) {
                $data_create = [
                    "product_id" => $data["product_id"],
                    "color" => null,
                    "color_image_id" => null,
                    "size" => $data["sizes"][$i],
                    "size_image_id" => $data["image_sizes"][$i] ?? null,
                    "quantity" => $data["variants_item_quantity"][1][$i] ?? 0,
                    "price" => $data["variants_item_price"][1][$i] ?? 0,
                ];
                $variants[] = $this->product_variant_repository->create($data_create);
            } else {
                $data_create = [
                    "product_id" => $data["product_id"],
                    "color" => $data["colors"][$i],
                    "color_image_id" => $data["image_colors"][$i] ?? null,
                    "size" => null,
                    "size_image_id" => null,
                    "quantity" => $data["variants_item_quantity"][0][$i] ?? 0,
                    "price" => $data["variants_item_price"][0][$i] ?? 0,
                ];
                $variants[] = $this->product_variant_repository->create($data_create);
            }
        }
        return $variants;
    }

    private function getArrayImages(array $images = null)
    {
        $image_ids = [];
        if ($images) {
            for ($i = 0; $i <= max(array_keys($images)); $i++) {
                if (isset($images[$i])) {
                    if (gettype($images[$i]) == "string") {
                        $image_ids[$i] = $this->uploader->getIdImage($images[$i]);
                    } else if ($image = $this->uploader->upload($images[$i])) {
                        $image_ids[$i] = $image->id;
                    } else {
                        info("upload eror");
                        continue;
                    }
                }
            }
        }
        return $image_ids;
    }
}
