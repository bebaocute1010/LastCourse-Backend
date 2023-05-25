<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->controller(AuthController::class)->group(function () {
    Route::middleware("auth")->group(function () {

    });

    Route::post("login", "login");
    Route::post("register", "register");
});