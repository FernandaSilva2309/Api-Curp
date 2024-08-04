<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurpController;
use App\Http\Controllers\UserController;

Route::apiResource('curps', CurpController::class);
Route::apiResource('users', UserController::class);

// Métodos adicionales
Route::put('/users/{id}/change-password', [UserController::class, 'changePassword']);
Route::post('/users/{id}/change-password', [UserController::class, 'changePassword']);
Route::get('/users/{id}/change-password', [UserController::class, 'changePassword']);

Route::post('/users/login', [UserController::class, 'login']);
