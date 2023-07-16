<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function searchProducts(
        array $keywords,
        array $filter_cats = null,
        $filter_price_min = null,
        $filter_price_max = null,
        $filter_rating = null,
        bool $sort_newest = false,
        bool $sort_sell = false,
        bool $sort_desc_price = null
    ) {
        $products = Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere("name", "like", "%" . $keyword . "%");
            }
        })
            ->when($filter_cats != null, function ($query) use ($filter_cats) {
                $query->whereIn("cat_id", $filter_cats);
            })
            ->when($filter_price_min != null, function ($query) use ($filter_price_min) {
                $query->where("price", ">=", $filter_price_min);
            })
            ->when($filter_price_max != null, function ($query) use ($filter_price_max) {
                $query->where("price", "<=", $filter_price_max);
            })
            ->when($filter_cats != null, function ($query) use ($filter_cats) {
                $query->whereIn("cat_id", $filter_cats);
            })
            ->when($filter_rating !== null, function ($query) use ($filter_rating) {
                $query->where("rating", ">=", $filter_rating);
            })
            ->when($sort_newest, function ($query) {
                $query->orderByDesc("created_at");
            })
            ->when($sort_sell, function ($query) {
                $query->orderByDesc("sold");
            })
            ->when($sort_desc_price !== null, function ($query) use ($sort_desc_price) {
                $query->orderBy("price", $sort_desc_price ? "desc" : "asc");
            })
            ->get();
        return $products;
    }

    public function getRecommendedProducts($page)
    {
        $products = collect([]);
        $per_page = 12;
        if (auth()->check()) {
            $cat_ids = auth()->user()->allProducts()->pluck("cat_id");

            $products = Product::whereIn("cat_id", function ($query) use ($cat_ids) {
                $query->select("id")
                    ->from("categories")
                    ->whereIn("id", $cat_ids)
                    ->orWhereIn("parent_id", $cat_ids);
            })
                ->orderByDesc("sold")
                ->get();
        }
        $all_products = Product::orderByDesc("sold")->get();
        $result = $products->concat($all_products)->unique()->slice(($page - 1) * $per_page, $per_page);
        return $result;
    }

    public function getTopSellingProducts()
    {
        return Product::orderByDesc("sold")->take(12)->get();
    }

    public function getFeaturedProducts()
    {
        return Product::all()->sortByDesc(function ($product) {
            return $product->getTotalRating();
        })->take(12);
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function findBySlug($slug)
    {
        return Product::where("slug", $slug)->first();
    }

    public function getDetails($slug)
    {
        return Product::with(['variants'])->where('slug', $slug)->first();
    }

    public function updateOrCreate(array $data)
    {
        if (isset($data["id"])) {
            $product = $this->find($data["id"]);
            $product->update($data);
            return $product;
        }
        return Product::create($data);
    }
}
