<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarrierResource;
use App\Services\CarrierService;

class CarrierController extends Controller
{
    private $carrier_service;

    public function __construct()
    {
        $this->carrier_service = new CarrierService();
    }

    public function getCarriers()
    {
        return CarrierResource::collection($this->carrier_service->getCarriers());
    }
}
