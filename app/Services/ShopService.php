<?php

namespace App\Services;

use App\Models\Shop;
use App\Repositories\ShopRepository;
use App\Repositories\WarehouseRepository;
use App\Utils\Uploader;
use Illuminate\Support\Str;

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

    public function filterProducts($products, $search_string = "")
    {
        $filtered_products = $products->filter(function ($product) use ($search_string) {
            if (str_contains(strtolower($product->name), strtolower($search_string))) {
                return true;
            }
            return false;
        })->values();
        return $filtered_products;
    }

    public function find($id)
    {
        return $this->shop_repository->find($id);
    }

    public function findBySlug($slug)
    {
        return $this->shop_repository->findBySlug($slug);
    }

    public function update($id, array $data)
    {
        $shop = $this->shop_repository->find($id);
        if (!$shop || $shop->user_id != $data["user_id"]) {
            return false;
        }
        $data["avatar"] = $this->uploader->upload($data["avatar"]);
        $data["banner"] = $this->uploader->upload($data["banner"]);
        $data["slug"] = $this->createSlug($data["name"]);
        $shop = $this->shop_repository->update($id, $data);
        return $shop;
    }

    public function create(array $data)
    {
        $data["avatar"] = $this->uploader->upload($data["avatar"]);
        $data["banner"] = $this->uploader->upload($data["banner"]);
        $data["slug"] = $this->createSlug($data["name"]);
        $shop = $this->shop_repository->create($data);
        return $shop;
    }

    private function createSlug($name)
    {
        $slug = Str::slug($name . " " . Str::random(10), "-");
        if (Shop::where("slug", $slug)->first()) {
            $this->createSlug($name);
        }
        return $slug;
    }

    public function updateRating($id)
    {
        if ($shop = $this->find($id)) {
            $shop->rating = $this->shop_repository->getAverageRating($shop);
            $shop->save();
        }
    }
}
