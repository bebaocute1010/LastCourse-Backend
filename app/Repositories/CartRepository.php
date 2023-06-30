<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function findCarts(array $ids)
    {
        return Cart::whereIn("id", $ids)->get();
    }

    public function getCartsSelected(array $selected)
    {
        return Cart::whereIn("id", $selected)->with('product.shop')->get();
    }

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
