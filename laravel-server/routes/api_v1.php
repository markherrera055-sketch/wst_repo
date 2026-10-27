<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/categories', CategoryController::class)
    ->only(['index', 'show']);

Route::get('/products/queries', [ProductController::class, 'queryMethod']);

Route::apiResource('/products', ProductController::class)
    ->only(['index', 'show']);