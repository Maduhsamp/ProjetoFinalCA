<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/user/verify-email', [UserController::class, 'sendVerificationEmail']);
Route::get('/user/verify-email/{id}/{token}', [UserController::class, 'verifyEmail']);
