<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Utils\Uploader;
use Illuminate\Support\Arr;

class ProductService
{
    private $product_repository;
    private $product_variant_service;
    private $discount_range_service;
    private $uploader;

    public function __construct()
    {
        $this->product_repository = new ProductRepository();
        $this->product_variant_service = new ProductVariantService();
        $this->discount_range_service = new DiscountRangeService();
        $this->uploader = new Uploader();
    }

    public function find($id)
    {
        return $this->product_repository->find($id);
    }

    public function delete($id)
    {
        $product = $this->find($id);
        if ($product) {
            foreach ($product->variants as $variants) {
                if ($variants->colorImage) {
                    $variants->colorImage->delete();
                }
                if ($variants->sizeImage) {
                    $variants->sizeImage->delete();
                }
                $variants->delete();
            }
            foreach ($product->discountRanges as $discount) {
                $discount->delete();
            }
            foreach ($product->images() as $image) {
                $image->delete();
            }
            return $product->delete();
        }
        return $product;
    }

    public function updateOrCreate(array $data, array $variant_keys, array $discount_keys)
    {
        if (Arr::exists($data, "images")) {
            $data = Arr::add($data, "image_ids", $this->getImageIds($data["images"]));
            Arr::forget($data, "images");
        }

        if (Arr::exists($data, "id") && $product = $this->find($data["id"])) {
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

        $except_keys = [];

        if (Arr::exists($data, "is_variant")) {
            $except_keys = array_merge($except_keys, $variant_keys);
        }
        if (Arr::exists($data, "is_buy_more_discount")) {
            $except_keys = array_merge($except_keys, $discount_keys);
        }
        if ($product = $this->product_repository->updateOrCreate(Arr::except($data, $except_keys))) {
            if ($product->is_variant) {
                $this->product_variant_service->create(
                    Arr::add(
                        Arr::only($data, $variant_keys),
                        "product_id",
                        $product->id
                    )
                );
            }
            if ($product->is_buy_more_discount) {
                $this->discount_range_service->create(
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

    public function getImageIds(array $images)
    {
        $ids = [];
        foreach ($images as $image) {
            $ids[] = $this->uploader->upload($image)->id;
        }
        return $ids;
    }
}
