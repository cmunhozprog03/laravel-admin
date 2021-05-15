<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::post('register', [AuthController::class, 'register']);
route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    route::get('user', [AuthController::class, 'user']);
});

