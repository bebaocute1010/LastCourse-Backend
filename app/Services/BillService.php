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

    public function __construct()
    {
        $this->bill_repository = new BillRepository();
        $this->carrier_repository = new CarrierRepository();
        $this->product_service = new ProductService();
        $this->bill_detail_service = new BillDetailService();
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
        $products = collect($data["products"]);
        Arr::forget($data, "products");
        $data["user_id"] = auth()->id(); // Sau nay thay la auth()->id()
        $data["shipping_fee"] = $this->getShippingFee($data["carrier_id"], $products->pluck("id")->toArray());

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

    public function getShippingFee($carrier_id, $product_ids)
    {
        $carrier = $this->carrier_repository->find($carrier_id);
        $total = 0;
        $coefficient = rand(110, 200) / 100;
        foreach ($product_ids as $product_id) {
            if ($product = $this->product_service->find($product_id)) {
                $total += $product->getShippingFee();
            }
        }

        // gia ship co ban * tong ship cac san pham * he so random
        return round($carrier->price *  (1 + $total) * $coefficient);
    }
}
