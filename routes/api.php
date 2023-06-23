<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->controller(AuthController::class)->group(function () {
    Route::middleware("auth")->group(function () {
        Route::post("change-password", "changePassword");
        Route::get("me", "me");
    });

    Route::post("login", "login");
    Route::post("register", "register");
    Route::post("verify-account", "verifyAccount");
    Route::post("register-information", "registerInformation");
    Route::post("get-otp", "sendOtp");
});

Route::prefix("product")->controller(ProductController::class)->group(function () {
    //middleware auth
    Route::post("create", "updateOrCreate");
    Route::post("update", "updateOrCreate");
    Route::delete("delete", "delete");
    //

    Route::get("details/{slug}", "getDetails");
});

Route::prefix("shop")->controller(ShopController::class)->group(function () {
    Route::post("create", "updateOrCreate");
    Route::post("update", "updateOrCreate");
    Route::delete("delete", "delete");
});

Route::prefix("cart")->controller(CartController::class)->middleware("auth:api")->group(function () {
    Route::post("create", "updateOrCreate");
    Route::post("update", "updateOrCreate");
    Route::delete("delete", "delete");
    Route::get("get", "getProducts");
});

Route::prefix("comment")->controller(CommentController::class)->group(function () {
    Route::post("create", "updateOrCreate");
    Route::post("update", "updateOrCreate");
    Route::delete("delete", "delete");
});

Route::prefix("bill")->controller(BillController::class)->group(function () {
    Route::post("create", "updateOrCreate");
    Route::put("confirm", "updateStatus");
    Route::put("delivery", "updateStatus");
    Route::put("success", "updateStatus");
    Route::put("return", "updateStatus");
    Route::put("cancel", "updateStatus");
});
