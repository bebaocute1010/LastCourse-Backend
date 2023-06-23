<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function create(array $data)
    {
        return Cart::create($data);
    }

    public function update($id, $quantity)
    {
        $cart = Cart::find($id);
        $cart->update(["quantity" => $quantity]);
        return $cart;
    }
}
