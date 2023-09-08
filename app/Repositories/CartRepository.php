<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function findCarts(array $ids)
    {
        return Cart::whereIn("id", $ids)->with(["product", "variant"])->get();
    }

    public function find($id = null, $user_id = null, $product_id = null, $product_variant_id = null)
    {
        if ($id) {
            return Cart::find($id);
        }
        if ($user_id && $product_id) {
            return Cart::where("user_id", $user_id)->where("product_id", $product_id)->where("product_variant_id", $product_variant_id)->first();
        }
        return null;
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
