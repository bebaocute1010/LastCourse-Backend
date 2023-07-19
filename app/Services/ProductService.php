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
    private $category_service;
    private $uploader;

    public function __construct()
    {
        $this->product_repository = new ProductRepository();
        $this->product_variant_service = new ProductVariantService();
        $this->discount_range_service = new DiscountRangeService();
        $this->shop_service = new ShopService();
        $this->category_service = new CategoryService();
        $this->uploader = new Uploader();
    }

    public function getProductsCategory($cat_id = null)
    {
        return $this->product_repository->getProductsCategory($cat_id);
    }

    public function getBreadcrumb($product)
    {
        $category_family = $this->category_service->getCategoryFamily($product->category);
        $categories_selected = $category_family["categories_selected"];
        $breadcrumb = [];
        foreach ($category_family["categories"] as $category) {
            $filter_categories = array_filter($category->toArray(), function ($item) use ($categories_selected) {
                return in_array($item["id"], $categories_selected);
            });

            $breadcrumb = array_merge($breadcrumb, $filter_categories);
        }
        $breadcrumb[] = ["id" => -1, "name" => $product->name];
        return $breadcrumb;
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
        bool $sort_desc_price = null,
        $type,
    ) {
        $per_page = 12;
        if ($filter_cats) {
            $categories = $this->category_service->getCategoriesInArray($filter_cats);
            $filter_cats = $this->getSubCategories($categories);
        }
        $products = $this->product_repository->searchProducts(
            $search,
            $filter_cats,
            $filter_price_min,
            $filter_price_max,
            $filter_rating,
            $sort_newest,
            $sort_sell,
            $sort_desc_price,
            $type
        );
        $num_page = ceil($products->count() / $per_page);
        $data["num_page"] = $num_page;
        $data["products"] = $products->slice(($page - 1) * $per_page, $per_page);
        $data["categories"] = $this->category_service->searchCategories($search);
        return $data;
    }

    public function getSubCategories($categories, $cat_ids = [])
    {
        foreach ($categories as $category) {
            if ($subCats = $category->subCategories) {
                $cat_ids = array_merge($cat_ids, $this->getSubCategories($subCats, $cat_ids));
            }
            $cat_ids[] = $category->id;
        }
        return array_unique($cat_ids);
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
            $product->breadcrumb = $this->getBreadcrumb($product);
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
                $variants->delete();
            }
            foreach ($product->discountRanges as $discount) {
                $discount->delete();
            }
            foreach ($product->carts as $cart) {
                $cart->delete();
            }
            return $product->delete();
        }
        return true;
    }

    public function updateOrCreate(array $data, array $variant_keys, array $discount_keys)
    {
        if (isset($data["id"])) {
            $product = $this->find($data["id"]);
        } else {
            $product = null;
        }
        if (Arr::exists($data, "images")) {
            $data["images"] = $this->uploader->getImagesUrl($data["images"]);
        }

        if (Arr::exists($data, "id") && $product) {
            if ($product->shop_id != $data["shop_id"]) {
                return false;
            }
            foreach ($product->variants as $variant) {
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
                $product->inventory = 0;
                foreach ($product->variants as $variant) {
                    $product->inventory += $variant->quantity;
                }
                $product->save();
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

    public function findImageIds(array $urls)
    {
        $image_ids = [];
        foreach ($urls as $url) {
            if ($id = $this->uploader->getIdImage($url)) {
                $image_ids[] = $id;
            }
        }
        return $image_ids;
    }
}
