<?php

namespace App\Services;

use App\Repositories\ProductConditionRepository;

class ProductConditionService
{
    private $condition_repository;

    public function __construct()
    {
        $this->condition_repository = new ProductConditionRepository();
    }

    public function getConditions()
    {
        return $this->condition_repository->getConditions();
    }
}
