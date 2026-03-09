<?php

use App\Http\Controllers\HomeImageController;
use App\Http\Controllers\HomeMovingTextController;
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

Route::prefix('/v1/home/text')->group(function () {
    Route::get('/', [HomeMovingTextController::class, 'index']);
    Route::post('/store', [HomeMovingTextController::class, 'store']);
    Route::get('/edit/{id}', [HomeMovingTextController::class, 'edit']);
    Route::put('/update/{id}', [HomeMovingTextController::class, 'update']);
    Route::delete('/destroy/{id}', [HomeMovingTextController::class, 'destroy']);
})->middleware('auth:sanctum');
