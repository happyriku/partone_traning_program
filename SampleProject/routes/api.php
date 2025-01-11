<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthCodesController;
use App\Http\Controllers\AuthMailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\MemberInfoController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register-user', [UserController::class, 'store']);

Route::post('/send-auth-code',[AuthCodesController::class, 'send_auth_code']);

Route::get('/verify-email',[AuthMailController::class, 'verify_email_address']);

Route::get('/login',[LoginController::class, 'login']);

Route::get('/password-change',[PasswordChangeController::class, 'change_password']);

Route::get('/password-reset',[PasswordResetController::class, 'send_password_reset_link']);

Route::get('/membership-info',[MemberInfoController::class, 'find_and_return_member_info']);
