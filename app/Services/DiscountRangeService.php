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
        return $this->discount_range_repository->create($data);
    }
}
