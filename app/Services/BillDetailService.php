<?php

namespace App\Services;

use App\Repositories\BillDetailRepository;

class BillDetailService
{
    private $bill_detail_repository;

    public function __construct()
    {
        $this->bill_detail_repository = new BillDetailRepository();
    }

    public function createDetails($bill_id, $products)
    {
        $details = [];
        foreach ($products as $product) {
            $details[] = $this->bill_detail_repository->create([
                "bill_id" => $bill_id,
                "product_id" => $product["id"],
                "product_variant_id" => $product["variant_id"] ?? null,
                "price" => $product["price"],
                "quantity" => $product["quantity"]
            ]);
        }
        return $details;
    }
}
