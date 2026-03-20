<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ShortUrlController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    /* User routes */
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);
    Route::patch('/user', [UserController::class, 'update']);
    Route::delete('/user', [UserController::class, 'destroy']);

    // Short URL routes
    Route::post('/urls', [ShortUrlController::class, 'store']);
    Route::get('/urls', [ShortUrlController::class, 'index']);
    Route::get('/urls/{url}', [ShortUrlController::class, 'show']);
    Route::put('/urls/{url}', [ShortUrlController::class, 'update']);
    Route::patch('/urls/{url}', [ShortUrlController::class, 'update']);
    Route::delete('/urls/{url}', [ShortUrlController::class, 'destroy']);
});
