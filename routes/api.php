<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->controller(AuthController::class)->group(function () {
    Route::middleware("auth")->group(function () {
    });

    Route::post("login", "login");
    Route::post("register", "register");
    Route::post("verify-account", "verifyAccount");
    Route::post("register-information", "registerInformation");
    Route::post("get-otp", "sendOtp");
});

Route::prefix("product")->controller(ProductController::class)->group(function () {
    Route::post("create", "create");
});
