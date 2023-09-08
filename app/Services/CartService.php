<?php

namespace App\Services;

use App\Repositories\CartRepository;

class CartService
{
    private $cart_repository;
    private $product_service;
    private $product_variant_service;

    public function __construct()
    {
        $this->cart_repository = new CartRepository();
        $this->product_service = new ProductService();
        $this->product_variant_service = new ProductVariantService();
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
            $data["quantity"] += $cart->quantity;
        }
        if ($cart) {
            return $this->update($cart->id, $data["quantity"]);
        }
        $product = $this->product_service->find($data["product_id"]);
        $variant = isset($data["product_variant_id"]) ? $this->product_variant_service->find($data["product_variant_id"]) : null;
        if ($this->isOutInventory($product, $data["quantity"], $variant)) {
            return null;
        }
        return $this->cart_repository->create($data);
    }

    public function update($id, $quantity)
    {
        $cart = $this->cart_repository->find($id);
        if ($this->isOutInventory($cart->product, $quantity, $cart->variant)) {
            return null;
        }
        return $this->cart_repository->update($id, $quantity);
    }

    private function isOutInventory($product, $quantity, $variant = null)
    {
        $inventory = (
            $variant != null
            ? $variant->quantity
            : $product->inventory
        );
        return $quantity > $inventory;
    }
}
