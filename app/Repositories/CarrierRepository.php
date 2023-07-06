<?php

namespace App\Repositories;

use App\Models\Carrier;

class CarrierRepository
{
    public function getAll()
    {
        return Carrier::all();
    }

    public function find($id)
    {
        return Carrier::find($id);
    }
}
