<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterInformationRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\VerifyAccountRequest;
use App\Services\AuthService;
use App\Ultis\MessageResource;
use App\Ultis\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

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
          ["email" => $data_validated["account"]],
          ['email' => 'email',]
        );
        if ($validator->fails()) {
            $credentials = ["username" => $data_validated['account'], "password" => $data_validated["password"]];
        } else {
            $credentials = ["email" => $data_validated['account'], "password" => $data_validated["password"]];
        }
        if (!$token = auth()->attempt($credentials)) {
            return Responses::unauthorized();
        }
        $token_data = Responses::makeTokenData($token);
        $token_data = Arr::add($token_data,"title", MessageResource::LOGIN_SUCCESS_TITLE);
        $token_data = Arr::add($token_data,"message", MessageResource::LOGIN_SUCCESS_MESSAGE);
        return Responses::successWithData($token_data);
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

    public function verifyAccount(VerifyAccountRequest $request)
    {
        $data_validated = $request->validated();
        if ($this->auth_service->verifyAccount($data_validated)) {
            return Responses::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::REGISTER_VERIFY_SUCCESS);
        }
        return Responses::error(MessageResource::OTP_INVALID, Response::HTTP_NOT_ACCEPTABLE);
    }

    public function registerInformation(RegisterInformationRequest $request)
    {
        try {
            $data_validated = $request->validated();
            if ($this->auth_service->registerInformation($data_validated)) {
                return Responses::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::REGISTER_INFORMATION_SUCCESS);
            }
            return Responses::error(MessageResource::REGISTER_NOT_VERIFY, Response::HTTP_NOT_ACCEPTABLE);
        } catch (\Throwable $exception) {
            return Responses::exceptionError($exception);
        }
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
