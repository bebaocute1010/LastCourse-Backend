<?php

namespace App\Services;

use App\Http\Controllers\DiscountRangeController;
use App\Http\Controllers\ProductVariantController;
use App\Repositories\ProductRepository;
use Illuminate\Support\Arr;

class ProductService
{
    private $product_repository;
    private $product_variant_ctl;
    private $discount_range_ctl;

    public function __construct()
    {
        $this->product_repository = new ProductRepository();
        $this->product_variant_ctl = new ProductVariantController();
        $this->discount_range_ctl = new DiscountRangeController();
    }

    public function find($id)
    {
        return $this->product_repository->find($id);
    }

    public function updateOrCreate(array $data, array $variant_keys, array $discount_keys)
    {
        $except_keys = [];
        if (Arr::exists($data, "is_variant")) {
            $except_keys = array_merge($except_keys, $variant_keys);
        }
        if (Arr::exists($data, "is_buy_more_discount")) {
            $except_keys = array_merge($except_keys, $discount_keys);
        }
        if ($product = $this->product_repository->updateOrCreate(Arr::except($data, $except_keys))) {
            if ($product->is_variant) {
                $this->product_variant_ctl->create(
                    Arr::add(
                        Arr::only($data, $variant_keys),
                        "product_id",
                        $product->id
                    )
                );
            }
            if ($product->is_buy_more_discount) {
                $this->discount_range_ctl->create(
                    Arr::add(
                        Arr::only($data, $discount_keys),
                        "product_id",
                        $product->id
                    )
                );
            }
        }
        return $product;
    }
}
