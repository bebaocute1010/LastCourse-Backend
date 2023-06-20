<?php

namespace App\Services;

use App\Repositories\ProductVariantRepository;

class ProductVariantService
{
    private $product_variant_repository;

    public function __construct()
    {
        $this->product_variant_repository = new ProductVariantRepository();
    }

    public function create(array $data)
    {
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
                $this->product_variant_repository->create($data_create);
            }
        }
        return true;
    }
}
