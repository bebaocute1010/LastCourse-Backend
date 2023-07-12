<?php

namespace App\Repositories;

use App\Models\Follower;

class FollowerRepository
{
    public function checkFollowed($user_id, $shop_id)
    {
        return Follower::where("user_id", $user_id)->where("shop_id", $shop_id)->first();
    }

    public function follow(array $data)
    {
        return Follower::create($data);
    }

    public function unFollow(array $data)
    {
        $follower = Follower::where("user_id", $data["user_id"])->where("shop_id", $data["shop_id"])->first();
        return $follower->forceDelete();
    }
}
