<?php

namespace App\Repositories;

use App\Models\Warehouse;

class WarehouseRepository
{
    public function create(array $data)
    {
        return Warehouse::create($data);
    }
}
