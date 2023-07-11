<?php

namespace App\Services;

use App\Repositories\BillRepository;
use App\Repositories\CarrierRepository;
use Illuminate\Support\Arr;

class BillService
{
    private $bill_repository;
    private $carrier_repository;
    private $product_service;
    private $bill_detail_service;
    private $cart_service;

    public function __construct()
    {
        $this->bill_repository = new BillRepository();
        $this->carrier_repository = new CarrierRepository();
        $this->product_service = new ProductService();
        $this->bill_detail_service = new BillDetailService();
        $this->cart_service = new CartService();
    }

    public function find($id)
    {
        return $this->bill_repository->find($id);
    }

    public function updateStatus($id, $status)
    {
        return $this->bill_repository->updateStatus($id, $status);
    }

    public function updateOrCreate(array $data, $id = null)
    {
        $carts = $this->cart_service->findCarts($data["cart_ids"]);
        $shop = $carts->first()->product->shop;
        $products = $carts->map(function ($cart) {
            return [
                "id" => $cart->product_id,
                "variant_id" => $cart->product_variant_id,
                "quantity" => $cart->quantity,
                "price" => $cart->product->price,
            ];
        });
        $data = array_merge($data, [
            "shop_id" => $shop->id,
            "carrier_id" => $shop->carrier_id,
            "user_id" => auth()->id(),
            "shipping_fee" => self::getShippingFee($shop->carrier_id, $products->pluck("id")),
        ]);
        foreach ($carts as $cart) {
            $cart->delete();
        }
        Arr::forget($data, "cart_ids");
        if (!$id) {
            $bill = $this->bill_repository->create($data);
        } else {
            $bill = $this->bill_repository->find($id);
            $bill->details->forceDelete();
            $bill->update($data);
        }
        $details = $this->bill_detail_service->createDetails($bill->id, $products);
        $total = collect($details)->map(function ($detail) {
            return $detail->price * $detail->quantity;
        })->toArray();

        $bill->update(["total" => array_sum($total) + $bill->shipping_fee]);
        return $bill;
    }

    public static function getShippingFee($carrier_id, $product_ids)
    {
        $billsv = new BillService();
        $carrier = $billsv->carrier_repository->find($carrier_id);
        $total = 0;
        foreach ($product_ids as $product_id) {
            if ($product = $billsv->product_service->find($product_id)) {
                $total += $product->getShippingFee();
            }
        }

        // gia ship co ban * tong ship cac san pham * he so random
        return intval(round($carrier->price *  (1 + $total)));
    }
}
