<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\FunilController;
use App\Http\Controllers\ContatoController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/login/name', [AuthController::class, 'getName']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/funil', [FunilController::class, 'index']);
    Route::get('/funil/{id}', [FunilController::class, 'show']);
    Route::post('/funil/create', [FunilController::class, 'store']);
    Route::put('funil/update/{id}', [FunilController::class, 'update']);
    Route::delete('/funil/delete/{id}', [FunilController::class, 'destroy']);
    Route::get('funil/{id}/contato', [ContatoController::class, 'index']);
    Route::get('funil/{funil_id}/contato/{id}', [ContatoController::class, 'show']);
    Route::post('/funil/{id}/contato', [ContatoController::class, 'store']);
    Route::patch('contato/{id}', [ContatoController::class, 'update']);
    Route::put('contato/etapa/{id}', [ContatoController::class, 'updateEtapa']);
    Route::put('contato/order/{id}', [ContatoController::class, 'updateOrder']);
    Route::delete('/contato/{id}', [ContatoController::class, 'destroy']);
});

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
Route::post('/user/verify-email', [UserController::class, 'sendVerificationEmail']);
Route::get('/user/verify-email/{id}/{token}', [UserController::class, 'verifyEmail']);
