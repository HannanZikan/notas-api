<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::post('/signup', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'auth']);

