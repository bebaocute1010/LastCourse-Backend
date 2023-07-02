<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductConditionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::prefix("get")->group(function () {
    Route::controller(CategoryController::class)->prefix("category")->group(function () {
        Route::get("search", "searchCategories");
        Route::get("level1", "getCategoriesLevel1");
        Route::get("level2", "getCategoriesLevel2");
    });

    Route::get("conditions", [ProductConditionController::class, "getConditions"]);

    Route::controller(ProductController::class)->group(function () {
        Route::any("search-products", "searchProducts");
        Route::get("featured-products", "getFeaturedProducts");
        Route::get("top-selling-products", "getTopSellingProducts");
        Route::get("recommended-products", "getRecommendedProducts");
    });

    Route::controller(ShopController::class)->group(function () {
        Route::get("shop/{id}", "getShopProfile");
    });
});

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
    Route::middleware(["auth:api", "shop"])->group(function () {
        Route::post("create", "updateOrCreate");
        Route::post("update", "updateOrCreate");
        Route::delete("delete", "delete");
    });

    Route::get("select-variants", "selectVariants");
    Route::get("details/{slug}", "getDetails");
    Route::get("comments/{slug}", "getComments");
});

Route::prefix("shop")->controller(ShopController::class)->middleware("auth:api")->group(function () {
    Route::post("create", "updateOrCreate");
    Route::middleware("shop")->group(function () {
        Route::post("update", "updateOrCreate");
        Route::delete("delete", "delete");

        Route::get("infor", "getInforShop");
        Route::get("bills", "getBills");
        Route::get("get-product", "getProduct");
        Route::get("products", "getProducts");
        Route::get("products", "getProducts");
    });
});

Route::prefix("cart")->controller(CartController::class)->middleware("auth:api")->group(function () {
    Route::post("create", "updateOrCreate");
    Route::post("update", "updateOrCreate");
    Route::delete("delete", "delete");

    Route::post("preview-order", "previewOrder");
    Route::get("get", "getProducts");
});

Route::prefix("comment")->controller(CommentController::class)->group(function () {
    Route::post("create", "updateOrCreate");
    Route::post("update", "updateOrCreate");
    Route::delete("delete", "delete");
});

Route::prefix("bill")->controller(BillController::class)->middleware("auth:api")->group(function () {
    Route::post("create", "updateOrCreate");
    Route::post("confirm", "updateStatus");
    Route::post("delivery", "updateStatus");
    Route::post("success", "updateStatus");
    Route::post("return", "updateStatus");
    Route::post("cancel", "updateStatus");

    Route::get("get", "getBills");
    Route::get("details", "getBillDetails");
});
