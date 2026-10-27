<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VariableScopeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/variable-scope', [VariableScopeController::class, 'index']);
Route::get('/global-scope/{name}', [VariableScopeController::class, 'read']);
Route::get('/greet/{name}', [VariableScopeController::class, 'greet']);