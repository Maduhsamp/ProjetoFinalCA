<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\FunilController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/login/name', [AuthController::class, 'getName']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/funil', [FunilController::class, 'index']); //aqui mostra todos os funis 
    Route::post('/funil/create', [FunilController::class, 'store']); //pra criar funis novos apenas nome neles
    Route::put('funil/update/{id}', [FunilController::class, 'update']); //atualiza o nome 
    Route::delete('/funil/delete/{id}', [FunilController::class, 'destroy']);//para excluir o funil
});

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
Route::post('/user/verify-email', [UserController::class, 'sendVerificationEmail']);
Route::get('/user/verify-email/{id}/{token}', [UserController::class, 'verifyEmail']);
