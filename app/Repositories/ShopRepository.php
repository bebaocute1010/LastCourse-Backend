<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository
{
    public function find($id)
    {
        return Shop::find($id);
    }

    public function create(array $data)
    {
        return Shop::create($data);
    }

    public function update($id, array $data)
    {
        $shop = $this->find($id);
        $shop->update($data);
        return $shop;
    }
}
