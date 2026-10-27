<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HumanResourceController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
// use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payroll', [HumanResourceController::class, 'payroll']);
Route::apiResource('products', ProductController::class);
Route::get('/formatProductName', [ProductController::class, 'formatProductName']);
// Route::get('/categories', [CategoryController::class, 'index']);

// Route::apiResource('/posts', PostController::class);
Route::apiResource('messages', MessageController::class);