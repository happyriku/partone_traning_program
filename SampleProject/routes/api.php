<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; //import namespace

//make endpoint for new user

Route::middleware('api')->group(function () {
    Route::post('/users', [UserController::class, 'store']);
});
