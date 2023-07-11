<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository
{
    public function find($id)
    {
        return Shop::find($id);
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
        $products = $shop->allProducts;
        foreach ($products as $product) {
            $totalRating += $product->getTotalRating();
            $ratingCount += $product->evaluateComments()->count();
        }
        return round($totalRating / $ratingCount, 1);
    }
}
