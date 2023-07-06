<?php

namespace App\Services;

use App\Repositories\ShopRepository;
use App\Utils\Uploader;
use Illuminate\Support\Arr;

class ShopService
{
    private $shop_repository;
    private $uploader;

    public function __construct()
    {
        $this->shop_repository = new ShopRepository();
        $this->uploader = new Uploader();
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
        return $this->shop_repository->update($id, $data);
    }

    public function create(array $data)
    {
        $data["avatar"] = $this->uploader->upload($data["avatar"])->id;
        $data["banner"] = $this->uploader->upload($data["banner"])->id;
        return $this->shop_repository->create($data);
    }

    public function updateRating($id)
    {
        if ($shop = $this->find($id)) {
            $shop->rating = $this->shop_repository->getAverageRating($shop);
            $shop->save();
        }
    }
}
