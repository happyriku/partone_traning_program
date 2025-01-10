<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthCodesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register-info', [UserController::class, 'store']);

Route::post('/send-auth-code',[AuthCodesController::class, 'send_auth_code']);
