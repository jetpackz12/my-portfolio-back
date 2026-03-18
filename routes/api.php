<?php

use App\Http\Controllers\AboutMeEducationalController;
use App\Http\Controllers\AboutMeImageController;
use App\Http\Controllers\AboutMeSkillController;
use App\Http\Controllers\AboutMeWorkController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeDescriptionController;
use App\Http\Controllers\HomeImageController;
use App\Http\Controllers\HomeMovingTextController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/login', [LoginController::class, 'login']);
Route::post('/v1/forgot_password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/v1/reset_password', [ResetPasswordController::class, 'reset']);

Route::get('/v1/home/image', [HomeImageController::class, 'index']);
Route::get('/v1/home/text', [HomeMovingTextController::class, 'index']);
Route::get('/v1/home/description', [HomeDescriptionController::class, 'index']);
Route::get('/v1/offer', [OfferController::class, 'index']);
Route::get('/v1/aboutme/work', [AboutMeWorkController::class, 'index']);
Route::get('/v1/aboutme/skill', [AboutMeSkillController::class, 'index']);
Route::get('/v1/aboutme/educational', [AboutMeEducationalController::class, 'index']);
Route::get('/v1/aboutme/image', [AboutMeImageController::class, 'index']);
Route::get('/v1/project', [ProjectController::class, 'index']);
Route::get('/v1/resume', [ResumeController::class, 'index']);
Route::get('/v1/contact', [ContactController::class, 'index']);

Route::get('/v1/resume/download/{id}', [ResumeController::class, 'download']);

Route::middleware('auth:sanctum')->prefix('/v1/home/image')->group(function () {
    Route::post('/store', [HomeImageController::class, 'store']);
    Route::get('/edit/{id}', [HomeImageController::class, 'edit']);
    Route::put('/update/{id}', [HomeImageController::class, 'update']);
    Route::delete('/destroy/{id}', [HomeImageController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/home/text')->group(function () {
    Route::post('/store', [HomeMovingTextController::class, 'store']);
    Route::get('/edit/{id}', [HomeMovingTextController::class, 'edit']);
    Route::put('/update/{id}', [HomeMovingTextController::class, 'update']);
    Route::delete('/destroy/{id}', [HomeMovingTextController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/home/description')->group(function () {
    Route::post('/store', [HomeDescriptionController::class, 'store']);
    Route::get('/edit/{id}', [HomeDescriptionController::class, 'edit']);
    Route::put('/update/{id}', [HomeDescriptionController::class, 'update']);
    Route::delete('/destroy/{id}', [HomeDescriptionController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/offer')->group(function () {
    Route::post('/store', [OfferController::class, 'store']);
    Route::get('/edit/{id}', [OfferController::class, 'edit']);
    Route::put('/update/{id}', [OfferController::class, 'update']);
    Route::delete('/destroy/{id}', [OfferController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/aboutme/work')->group(function () {
    Route::post('/store', [AboutMeWorkController::class, 'store']);
    Route::get('/edit/{id}', [AboutMeWorkController::class, 'edit']);
    Route::put('/update/{id}', [AboutMeWorkController::class, 'update']);
    Route::delete('/destroy/{id}', [AboutMeWorkController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/aboutme/skill')->group(function () {
    Route::post('/store', [AboutMeSkillController::class, 'store']);
    Route::get('/edit/{id}', [AboutMeSkillController::class, 'edit']);
    Route::put('/update/{id}', [AboutMeSkillController::class, 'update']);
    Route::delete('/destroy/{id}', [AboutMeSkillController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/aboutme/educational')->group(function () {
    Route::post('/store', [AboutMeEducationalController::class, 'store']);
    Route::get('/edit/{id}', [AboutMeEducationalController::class, 'edit']);
    Route::put('/update/{id}', [AboutMeEducationalController::class, 'update']);
    Route::delete('/destroy/{id}', [AboutMeEducationalController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/aboutme/image')->group(function () {
    Route::post('/store', [AboutMeImageController::class, 'store']);
    Route::get('/edit/{id}', [AboutMeImageController::class, 'edit']);
    Route::put('/update/{id}', [AboutMeImageController::class, 'update']);
    Route::delete('/destroy/{id}', [AboutMeImageController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/project')->group(function () {
    Route::post('/store', [ProjectController::class, 'store']);
    Route::get('/edit/{id}', [ProjectController::class, 'edit']);
    Route::put('/update/{id}', [ProjectController::class, 'update']);
    Route::delete('/destroy/{id}', [ProjectController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/resume')->group(function () {
    Route::post('/store', [ResumeController::class, 'store']);
    Route::get('/edit/{id}', [ResumeController::class, 'edit']);
    Route::put('/update/{id}', [ResumeController::class, 'update']);
    Route::delete('/destroy/{id}', [ResumeController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/v1/contact')->group(function () {
    Route::post('/store', [ContactController::class, 'store']);
    Route::get('/edit/{id}', [ContactController::class, 'edit']);
    Route::put('/update/{id}', [ContactController::class, 'update']);
    Route::delete('/destroy/{id}', [ContactController::class, 'destroy']);
});
