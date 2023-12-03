<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/invoices', InvoiceController::class);
});
Route::post('/invoices/{invoice}/sendNotification', [InvoiceController::class, 'sendNotification']);

Route::post('/signup', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'auth']);

