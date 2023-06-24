<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getRecommendedProducts($page)
    {
        $products = collect([]);
        $perPage = 12;
        if (auth()->check()) {
            $catIds = auth()->user()->allProducts()->pluck("cat_id");

            $products = Product::whereIn("cat_id", function ($query) use ($catIds) {
                $query->select("id")
                    ->from("categories")
                    ->whereIn("id", $catIds)
                    ->orWhereIn("parent_id", $catIds);
            })
                ->skip(($page - 1) * $perPage)
                ->orderByDesc("sold")
                ->get();
        }
        $all_products = Product::orderByDesc("sold")->get();
        $result = $products->concat($all_products)->unique()->slice(($page - 1) * $perPage, $perPage);
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
