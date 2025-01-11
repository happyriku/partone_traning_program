<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthCodesController;
use App\Http\Controllers\AuthMailController;
use App\Http\Controllers\LoginController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register-user', [UserController::class, 'store']);

Route::post('/send-auth-code',[AuthCodesController::class, 'send_auth_code']);

Route::get('/verify-email',[AuthMailController::class, 'verify_email_address']);

Route::get('/login',[LoginController::class, 'login']);
