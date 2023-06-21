<?php

namespace App\Services;

use App\Repositories\DiscountRangeRepository;

class DiscountRangeService
{
    private $discount_range_repository;

    public function __construct()
    {
        $this->discount_range_repository = new DiscountRangeRepository();
    }

    public function create(array $data)
    {
        $discount_ranges = [];
        for ($i = 0; $i < count($data["discount_ranges_min"]); $i++) {
            $data_create = [
                "product_id" => $data["product_id"],
                "min" => $data["discount_ranges_min"][$i],
                "max" => $data["discount_ranges_max"][$i],
                "amount" => $data["discount_ranges_amount"][$i],
            ];
            $discount_ranges[] = $this->discount_range_repository->create($data_create);
        }
        return $discount_ranges;
    }
}
