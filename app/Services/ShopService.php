<?php

namespace App\Services;

use App\Repositories\ShopRepository;
use App\Repositories\WarehouseRepository;
use App\Utils\Uploader;
use Illuminate\Support\Arr;

class ShopService
{
    private $shop_repository;
    private $warehouse_repository;
    private $uploader;

    public function __construct()
    {
        $this->shop_repository = new ShopRepository();
        $this->warehouse_repository = new WarehouseRepository();
        $this->uploader = new Uploader();
    }

    public function filterProducts($products, $search_string)
    {
        $keywords = explode(" ", strtolower($search_string));

        $filtered_products = $products->filter(function ($product) use ($keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains(strtolower($product->name), $keyword)) {
                    return true;
                }
            }
            return false;
        })->values();
        return $filtered_products;
    }

    public function find($id)
    {
        return $this->shop_repository->find($id);
    }

    public function update($id, array $data)
    {
        $shop = $this->shop_repository->find($id);
        if (!$shop || $shop->user_id != $data["user_id"]) {
            return false;
        }
        if (gettype($data["avatar"]) != "string") {
            $data["avatar"] = $this->uploader->upload($data["avatar"], $shop->avatar)->id;
        } else {
            Arr::forget($data, "avatar");
        }
        if (gettype($data["banner"]) != "string") {
            $data["banner"] = $this->uploader->upload($data["banner"], $shop->banner)->id;
        } else {
            Arr::forget($data, "banner");
        }
        $warehouse = $data["warehouse"];
        unset($data["warehouse"]);
        $shop = $this->shop_repository->update($id, $data);
        $shop->warehouse->update($warehouse);
        return $shop;
    }

    public function create(array $data)
    {
        $data["avatar"] = $this->uploader->upload($data["avatar"])->id;
        $data["banner"] = $this->uploader->upload($data["banner"])->id;
        $warehouse = $data["warehouse"];
        info($data);
        unset($data["warehouse"]);
        $shop = $this->shop_repository->create($data);
        $warehouse["shop_id"] = $shop->id;
        if ($this->warehouse_repository->create($warehouse)) {
            return $shop;
        } else {
            $shop->forceDelete();
            return null;
        }
    }

    public function updateRating($id)
    {
        if ($shop = $this->find($id)) {
            $shop->rating = $this->shop_repository->getAverageRating($shop);
            $shop->save();
        }
    }
}
