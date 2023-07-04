<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    private $cart_repository;

    public function __construct()
    {
        $this->cart_repository = new CartRepository();
    }

    public function findCarts(array $cart_ids)
    {
        return $this->cart_repository->findCarts($cart_ids);
    }

    public function getProductsSelected(array $selected)
    {
        $carts = $this->cart_repository->getCartsSelected($selected);
        $carts_by_shop = $carts->groupBy("product.shop.id");
        $groupedCarts = $carts_by_shop->map(function ($carts) {
            $shop = $carts->first()->product->shop;
            $productIds = $carts->pluck('product.id')->unique()->toArray();
            return [
                "shop" => $shop,
                "shipping_fee" => BillService::getShippingFee($shop->carrier_id, $productIds),
                "carts" => $carts,
            ];
        })->values();
        return $groupedCarts;
    }

    public function create(array $data)
    {
        if ($cart = $this->cart_repository->find(null, $data["user_id"], $data["product_id"], $data["product_variant_id"])) {
            $quantity = $data["quantity"] + $cart->quantity;
            return $this->update($cart->id, $quantity);
        }
        return $this->cart_repository->create($data);
    }

    public function update($id, $quantity)
    {
        return $this->cart_repository->update($id, $quantity);
    }
}
