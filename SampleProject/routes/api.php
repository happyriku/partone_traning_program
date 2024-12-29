<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
	Route::apiResource('users', APP\Http\Controllers\UserController::class));
