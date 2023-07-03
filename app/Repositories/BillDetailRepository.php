<?php

namespace App\Repositories;

use App\Models\BillDetail;

class BillDetailRepository
{
    public function find($id)
    {
        return BillDetail::find($id);
    }

    public function create(array $data)
    {
        return BillDetail::create($data);
    }
}
