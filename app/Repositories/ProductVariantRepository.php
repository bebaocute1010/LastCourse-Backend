<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository
{
    public function find($id)
    {
        return ProductVariant::find($id);
    }

    public function create(array $data)
    {
        ProductVariant::create($data);
    }
}
