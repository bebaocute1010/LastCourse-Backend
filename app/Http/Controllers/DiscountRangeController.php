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
        return $this->discount_range_service->create($data);
    }
}
