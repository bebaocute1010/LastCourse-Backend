<?php

namespace App\Repositories;

use App\Models\Carrier;

class CarrierRepository
{
    public function find($id)
    {
        return Carrier::find($id);
    }
}
