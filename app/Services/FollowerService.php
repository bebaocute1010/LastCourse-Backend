<?php

namespace App\Services;

use App\Repositories\FollowerRepository;

class FollowerService
{
    private $follower_repository;

    public function __construct()
    {
        $this->follower_repository = new FollowerRepository();
    }

    public function checkFollowed($shop_id)
    {
        if ($this->follower_repository->checkFollowed(auth()->id(), $shop_id)) {
            return true;
        }
        return false;
    }

    public function follow($shop_id)
    {
        return $this->follower_repository->follow(["user_id" => auth()->id(), "shop_id" => $shop_id]);
    }

    public function unFollow($shop_id)
    {
        return $this->follower_repository->unFollow(["user_id" => auth()->id(), "shop_id" => $shop_id]);
    }
}
