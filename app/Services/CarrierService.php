<?php

namespace App\Services;

use App\Repositories\CarrierRepository;

class CarrierService
{
    private $carrier_repository;

    public function __construct()
    {
        $this->carrier_repository = new CarrierRepository();
    }

    public function getCarriers()
    {
        return $this->carrier_repository->getAll();
    }
}
