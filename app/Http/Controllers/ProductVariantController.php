<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductVariantService;

class ProductVariantController extends Controller
{
    private $product_variant_service;

    public function __construct()
    {
        $this->product_variant_service = new ProductVariantService();
    }

    public function create(array $data)
    {
        return $this->product_variant_service->create($data);
    }

}
