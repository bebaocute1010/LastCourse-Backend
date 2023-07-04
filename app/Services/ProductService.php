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
    private $shop_service;
    private $uploader;

    public function __construct()
    {
        $this->product_repository = new ProductRepository();
        $this->product_variant_service = new ProductVariantService();
        $this->discount_range_service = new DiscountRangeService();
        $this->shop_service = new ShopService();
        $this->uploader = new Uploader();
    }

    public function findBySlug(string $slug)
    {
        return $this->product_repository->findBySlug($slug);
    }

    public function searchProducts(
        string $search,
        $page,
        array $filter_cats = null,
        $filter_price_min = null,
        $filter_price_max = null,
        $filter_rating = null,
        bool $sort_newest = false,
        bool $sort_sell = false,
        bool $sort_desc_price = null
    ) {
        $per_page = 12;
        $key_words = $search ? explode(" ", $search) : [];
        $products = $this->product_repository->searchProducts(
            $key_words,
            $filter_cats,
            $filter_price_min,
            $filter_price_max,
            $filter_rating,
            $sort_newest,
            $sort_sell,
            $sort_desc_price,
        );
        $num_page = ceil($products->count() / $per_page);
        $data["num_page"] = $num_page;
        $data["products"] = $products->slice(($page - 1) * $per_page, $per_page);
        return $data;
    }

    public function getRecommendedProducts($page)
    {
        return $this->product_repository->getRecommendedProducts($page);
    }

    public function getTopSellingProducts()
    {
        return $this->product_repository->getTopSellingProducts();
    }

    public function getFeaturedProducts()
    {
        return $this->product_repository->getFeaturedProducts();
    }

    public function getDetails($slug)
    {
        if ($product = $this->product_repository->getDetails($slug)) {
            return $product;
        }
        return false;
    }

    public function updateRating($id)
    {
        if ($product = $this->find($id)) {
            $product->rating = $product->getAverageRating();
            $product->save();
            $this->shop_service->updateRating($product->shop_id);
        }
    }

    public function find($id)
    {
        return $this->product_repository->find($id);
    }

    public function delete($id)
    {
        $product = $this->find($id);
        $shop = auth()->user()->shop;
        if (!$product || !$shop || $product->shop_id != $shop->id) {
            return false;
        }
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
        return true;
    }

    public function updateOrCreate(array $data, array $variant_keys, array $discount_keys)
    {
        if (Arr::exists($data, "images")) {
            $data = Arr::add($data, "image_ids", $this->uploader->getImageIds($data["images"]));
            Arr::forget($data, "images");
        }

        if (Arr::exists($data, "id") && $product = $this->find($data["id"])) {
            if ($product->shop_id != $data["shop_id"]) {
                return false;
            }
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
}
