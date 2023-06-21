<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function find($id)
    {
        return Product::find($id);
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
