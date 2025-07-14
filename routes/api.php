<?php

use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('/person', PersonController::class);

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);
Route::middleware('auth:api')->post('/user/logout', [UserController::class, 'logout']);
