<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\ShopRepository;
use App\Utils\Uploader;

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
        if (isset($data["avatar"])) {
            $data["avatar"] = $this->uploader->upload($data["avatar"], $shop->avatar)->id;
        }
        return $this->shop_repository->update($id, $data);
    }

    public function create(array $data)
    {
        if (isset($data["avatar"])) {
            $data["avatar"] = $this->uploader->upload($data["avatar"])->id;
        } else {
            $data["avatar"] = $this->uploader->getDefaultAvatar();
        }
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
