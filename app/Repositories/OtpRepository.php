<?php

namespace App\Repositories;

use App\Models\Otp;

class OtpRepository
{
    public function getOtp($user_id)
    {
        return Otp::where("user_id", $user_id)->first();
    }

    public function updateOrCreate(array $data)
    {
        return Otp::updateOrCreate(
            ["user_id" => $data["user_id"]],
            ["otp" => $data["otp"], "expired_at" => $data["expired_at"]]
        );
    }
}
