<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterInformationRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\VerifyAccountRequest;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Utils\MessageResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private $auth_service;

    public function __construct()
    {
        $this->auth_service = new AuthService();
    }
    
    public function getNumberCart()
    {
        return JsonResponse::successWithData(["number_cart" => auth()->user()->carts->count()]);
    }

    public function markReadAllNotifications() {
        auth()->user()->unreadNotifications->markAsRead();
        if ($shop = auth()->user()->shop) {
            $shop->unreadNotifications->markAsRead();
        }
        return response()->json();
    }

    public function getNotiifications()
    {
        $notifications = auth()->user()->notifications;
        if ($shop = auth()->user()->shop) {
            $notifications = $notifications->merge($shop->notifications)->sortBy('read_at');
        }
        return NotificationResource::collection($notifications);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data_validated = $request->validated();
        if ($this->auth_service->updateProfile($data_validated)) {
            return JsonResponse::success(MessageResource::DEFAULT_SUCCESS_TITLE, MessageResource::USER_PROFILE_UPDATE_SUCCESS);
        }
        return JsonResponse::error("Fail", JsonResponse::HTTP_CONFLICT);
    }

    public function login(LoginRequest $request)
    {
        $data_validated = $request->validated();
        $validator = Validator::make(
            ["email" => $data_validated["account"]],
            ["email" => "email"]
        );
        if ($validator->fails()) {
            $credentials = [
                "username" => $data_validated["account"],
                "password" => $data_validated["password"],
            ];
        } else {
            $credentials = [
                "email" => $data_validated["account"],
                "password" => $data_validated["password"],
            ];
        }
        if (!$token = auth()->attempt($credentials)) {
            return JsonResponse::unauthorized();
        }
        $token_data = collect(JsonResponse::makeTokenData($token))->merge([
            "title" => MessageResource::LOGIN_SUCCESS_TITLE,
            "message" => MessageResource::LOGIN_SUCCESS_MESSAGE,
        ])->all();
        return JsonResponse::successWithData($token_data);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data_validated = $request->validated();
        if (Hash::check($data_validated["password"], auth()->user()->password)) {
            $this->auth_service->changePassword($data_validated["new_password"]);
            $response = array_merge($this->refresh(), [
                "title" => MessageResource::DEFAULT_SUCCESS_TITLE,
                "message" => MessageResource::CHANGE_PASSWORD_SUCCESS,
            ]);
            return JsonResponse::successWithData($response);
        }
        return JsonResponse::error(MessageResource::AUTH_PASSWORD_NOT_CORRECT, JsonResponse::HTTP_NON_AUTHORITATIVE_INFORMATION);
    }

    public function register(RegisterRequest $request)
    {
        $data_validated = $request->validated();
        $this->auth_service->register($data_validated);
        return JsonResponse::success(
            MessageResource::REGISTER_SUCCESS_TITLE,
            MessageResource::REGISTER_SUCCESS_MESSAGE
        );
    }

    public function verifyAccount(VerifyAccountRequest $request)
    {
        $data_validated = $request->validated();
        if ($this->auth_service->verifyAccount($data_validated)) {
            return JsonResponse::success(
                MessageResource::DEFAULT_SUCCESS_TITLE,
                MessageResource::REGISTER_VERIFY_SUCCESS
            );
        }
        return JsonResponse::error(
            MessageResource::OTP_INVALID,
            Response::HTTP_NOT_ACCEPTABLE
        );
    }

    public function registerInformation(RegisterInformationRequest $request)
    {
        try {
            $data_validated = $request->validated();
            $status = $this->auth_service->registerInformation($data_validated);
            switch ($status) {
                case User::STATUS_OK:
                    return JsonResponse::error(
                        MessageResource::REGISTER_INFORMATION_UPDATED,
                        Response::HTTP_NOT_ACCEPTABLE
                    );
                case User::STATUS_NOT_VERIFY:
                    return JsonResponse::error(
                        MessageResource::REGISTER_NOT_VERIFY,
                        Response::HTTP_NOT_ACCEPTABLE
                    );
                case User::STATUS_NOT_EXIST:
                    return JsonResponse::error(
                        MessageResource::ACCOUNT_NOT_EXIST,
                        Response::HTTP_NOT_ACCEPTABLE
                    );
                case User::STATUS_NOT_REGISTER_INFORMATION:
                    return JsonResponse::success(
                        MessageResource::DEFAULT_SUCCESS_TITLE,
                        MessageResource::REGISTER_INFORMATION_SUCCESS
                    );
            }
            return JsonResponse::error(MessageResource::DEFAULT_FAIL_MESSAGE, Response::HTTP_CONFLICT);
        } catch (QueryException $exception) {
            if ($exception->getCode() == 23000 && Str::contains($exception->getMessage(), "Duplicate")) {
                return JsonResponse::error(
                    MessageResource::REGISTER_USERNAME_EXIST,
                    Response::HTTP_NOT_ACCEPTABLE
                );
            }
            return JsonResponse::exceptionError($exception);
        }
    }

    public function sendOtp(SendOtpRequest $request)
    {
        $data_validated = $request->validated();
        return JsonResponse::successWithData(
            $this->auth_service->sendOtp($data_validated["email"])
        );
    }

    public function me()
    {
        return new UserResource(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return JsonResponse::success(
            MessageResource::DEFAULT_SUCCESS_TITLE,
            MessageResource::LOGOUT_SUCCESS_MESSAGE
        );
    }

    public function refresh()
    {
        return JsonResponse::makeTokenData(auth()->refresh());
    }
}
