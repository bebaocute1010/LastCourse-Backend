<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
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
