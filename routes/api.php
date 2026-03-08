<?php

use App\Http\Controllers\HomeImageController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/login', [LoginController::class, 'login']);

Route::prefix('/v1/home/image')->group(function () {
    Route::get('/', [HomeImageController::class, 'index']);
    Route::post('/store', [HomeImageController::class, 'store']);
    Route::get('/edit/{id}', [HomeImageController::class, 'edit']);
    Route::put('/update/{id}', [HomeImageController::class, 'update']);
    Route::delete('/destroy/{id}', [HomeImageController::class, 'destroy']);
})->middleware('auth:sanctum');
