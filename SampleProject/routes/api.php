<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; //import namespace

//make endpoint for new user

Route::prefix('api')->group(function () {
	Route::post('/users', [UserController::class, 'store']);
});
