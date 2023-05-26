<?php

namespace App\Services;

use App\Http\Controllers\OtpMailJobController;
use App\Mail\OtpMail;
use App\Models\User;
use App\Repositories\OtpRepository;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    private $otp_repository;
    private $otp_mail_job_controller;

    public function __construct()
    {
        $this->otp_repository = new OtpRepository();
        $this->otp_mail_job_controller = new OtpMailJobController();
    }

    public function getOtp($user_id)
    {
        return $this->otp_repository->getOtp($user_id);
    }

    public function sendOtp(User $user)
    {
        $otp = $this->getOtp($user->id);
        if (!$otp || $otp->expired_at < now()) {
            $otp = $this->updateOrCreate($user->id);
            $this->otp_mail_job_controller->processQueue($user->email, new OtpMail($otp->otp));
        }
        return $otp;
    }

    public function verifyOtp($user_id, $otp_code)
    {
        $otp = $this->getOtp($user_id);
        return $otp->otp == $otp_code && $otp->expired_at > now();
    }

    public function updateOrCreate($user_id)
    {
        $expired_at = now()->addMinutes(2);
        $random_otp = random_int(100000, 999999);
        return $this->otp_repository->updateOrCreate([
            "user_id" => $user_id,
            "otp" => $random_otp,
            "expired_at" => $expired_at,
        ]);
    }
}
