<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductConditionResource;
use App\Services\ProductConditionService;
use Illuminate\Http\Request;

class ProductConditionController extends Controller
{
    private $condition_service;

    public function __construct()
    {
        $this->condition_service = new ProductConditionService();
    }
    public function getConditions()
    {
        return ProductConditionResource::collection($this->condition_service->getConditions());
    }
}
