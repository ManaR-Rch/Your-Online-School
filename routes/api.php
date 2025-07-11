<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PurchaseController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->get('/me', [AuthController::class, 'me']);
Route::middleware(['auth:api', 'admin'])->apiResource('courses', CourseController::class);
Route::middleware(['auth:api', 'admin'])->post('/upload', [UploadController::class, 'upload']);
Route::middleware(['auth:api'])->post('/purchase', [PurchaseController::class, 'purchase']); 