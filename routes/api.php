<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("users", UserController::class);

Route::apiResource("users.products", ProductController::class);

Route::apiResource('products.orders', OrderController::class);

Route::apiResource("users.offers", OfferController::class);