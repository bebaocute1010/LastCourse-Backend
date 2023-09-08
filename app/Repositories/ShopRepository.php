<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository
{
    public function find($id)
    {
        return Shop::find($id);
    }

    public function findBySlug($slug)
    {
        return Shop::where("slug", $slug)->first();
    }

    public function create(array $data)
    {
        return Shop::create($data);
    }

    public function update($id, array $data)
    {
        $shop = $this->find($id);
        $shop->update($data);
        return $shop;
    }

    public function getAverageRating(Shop $shop)
    {
        $totalRating = 0;
        $ratingCount = 0;
        $products = $shop->allProducts()->with("allComments")->get();
        foreach ($products as $product) {
            $totalRating += $product->allComments->sum("rating");
            $ratingCount += $product->allComments->count();
        }
        return $totalRating / $ratingCount;
    }
}
