<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("auth", [AuthController::class, "login"]);

Route::middleware("auth:api")->group(function() {
    Route::apiResource("users", UserController::class);

    Route::apiResource("users.products", ProductController::class);

    Route::apiResource('products.orders', OrderController::class);

    Route::apiResource("users.offers", OfferController::class);


    
    Route::get("auth/current", [AuthController::class, "current"]);
    Route::put("auth/update", [AuthController::class, "updateCurrentUserPassword"]);
    Route::get("auth/logout", [AuthController::class, "logout"]);
});