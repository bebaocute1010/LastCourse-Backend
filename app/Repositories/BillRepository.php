<?php

namespace App\Repositories;

use App\Models\Bill;

class BillRepository
{
    public function find($id)
    {
        return Bill::find($id);
    }

    public function updateStatus($id, $status)
    {
        $bill = $this->find($id);
        $bill->update(["status" => $status]);
        return $bill;
    }

    public function create(array $data)
    {
        return Bill::create($data);
    }
}
