<?php

namespace App\Services;

use App\Jobs\OtpMailJob;
use App\Mail\OtpMail;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    private $user_repository;
    private $otp_service;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->otp_service     = new OtpService();
    }

    public function register(array $data)
    {
        do {
            $invite_code = Str::random(10);
        } while ($this->user_repository->findUser("invite_code", $invite_code));
        $user = $this->user_repository->create(Arr::add($data, "invite_code", $invite_code));
        $this->sendOtp($user->email);
        return $user;
    }

    public function sendOtp(string $email)
    {
        $user = $this->user_repository->findUser("email", $email);
        $otp  = $this->otp_service->sendOtp($user);
        return ["expired_at" => $otp->expired_at];
    }

    public function verifyAccount(array $data)
    {
        if ($user = $this->user_repository->findUser("email", $data["email"])) {
            if ($this->otp_service->verifyOtp($user->id, $data["otp"])) {
                $this->user_repository->update(array("id" => $user->id, "email_verified_at" => Carbon::now()));
                return true;
            }
        }
        return false;
    }

}