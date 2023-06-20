<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository
{
    public function create(array $data)
    {
        ProductVariant::create($data);
    }
}
