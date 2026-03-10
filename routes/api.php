<?php

use App\Http\Controllers\AboutMeWorkController;
use App\Http\Controllers\HomeDescriptionController;
use App\Http\Controllers\HomeImageController;
use App\Http\Controllers\HomeMovingTextController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfferController;
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

Route::prefix('/v1/home/description')->group(function () {
    Route::get('/', [HomeDescriptionController::class, 'index']);
    Route::post('/store', [HomeDescriptionController::class, 'store']);
    Route::get('/edit/{id}', [HomeDescriptionController::class, 'edit']);
    Route::put('/update/{id}', [HomeDescriptionController::class, 'update']);
    Route::delete('/destroy/{id}', [HomeDescriptionController::class, 'destroy']);
})->middleware('auth:sanctum');

Route::prefix('/v1/offer')->group(function () {
    Route::get('/', [OfferController::class, 'index']);
    Route::post('/store', [OfferController::class, 'store']);
    Route::get('/edit/{id}', [OfferController::class, 'edit']);
    Route::put('/update/{id}', [OfferController::class, 'update']);
    Route::delete('/destroy/{id}', [OfferController::class, 'destroy']);
})->middleware('auth:sanctum');

Route::prefix('/v1/aboutme/work')->group(function () {
    Route::get('/', [AboutMeWorkController::class, 'index']);
    Route::post('/store', [AboutMeWorkController::class, 'store']);
    Route::get('/edit/{id}', [AboutMeWorkController::class, 'edit']);
    Route::put('/update/{id}', [AboutMeWorkController::class, 'update']);
    Route::delete('/destroy/{id}', [AboutMeWorkController::class, 'destroy']);
})->middleware('auth:sanctum');
