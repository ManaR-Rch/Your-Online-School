<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->get('/me', [AuthController::class, 'me']);
Route::middleware(['auth:api', 'admin'])->apiResource('courses', CourseController::class); 