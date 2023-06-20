<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DiscountRangeService;
use Illuminate\Http\Request;

class DiscountRangeController extends Controller
{
    private $discount_range_service;

    public function __construct()
    {
        $this->discount_range_service = new DiscountRangeService();
    }

    public function create(array $data)
    {
        for ($i = 0; $i < count($data["discount_ranges_min"]); $i++) {
            $data_create = [
                "product_id" => $data["product_id"],
                "min" => $data["discount_ranges_min"][$i],
                "max" => $data["discount_ranges_max"][$i],
                "amount" => $data["discount_ranges_amount"][$i],
            ];
            $this->discount_range_service->create($data_create);
        }
        return true;
    }
}
