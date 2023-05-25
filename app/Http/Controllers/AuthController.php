<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendOtpRequest;
use App\Services\AuthService;
use App\Ultis\MessageResource;
use App\Ultis\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $auth_service;

    public function __construct()
    {
        $this->auth_service = new AuthService();
    }

    public function login(LoginRequest $request)
    {
        $data_validated = $request->validated();
        $validator      = Validator::make(
          ["email" => $data_validated["email"]],
          ['email' => 'email',]
        );
        if ($validator->fails()) {
            $credentials = $data_validated(['username', 'password']);
        } else {
            $credentials = $data_validated(['email', 'password']);
        }
        if (!$token = auth()->attempt($credentials)) {
            return Responses::unauthorized();
        }
        return Responses::successWithToken($token);
    }

    public function register(RegisterRequest $request)
    {
        $data_validated = $request->validated();
        $this->auth_service->register($data_validated);
        return Responses::success(
          MessageResource::REGISTER_SUCCESS_TITLE,
          MessageResource::REGISTER_SUCCESS_MESSAGE
        );
    }

    public function sendOtp(SendOtpRequest $request)
    {
        $data_validated = $request->validated();
        return Responses::successWithData(
          $this->auth_service->sendOtp($data_validated["email"])
        );
    }

    public function me()
    {
        return Responses::successWithData(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return Responses::success(
          MessageResource::DEFAULT_SUCCESS_TITLE,
          MessageResource::LOGOUT_SUCCESS_MESSAGE
        );
    }

    public function refresh()
    {
        return Responses::successWithToken(auth()->refresh());
    }
}
