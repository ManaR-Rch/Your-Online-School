<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProgressionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->get('/me', [AuthController::class, 'me']);
Route::middleware(['auth:api', 'admin'])->apiResource('courses', CourseController::class);
Route::middleware(['auth:api', 'admin'])->post('/upload', [UploadController::class, 'upload']);
Route::middleware(['auth:api'])->post('/purchase', [PurchaseController::class, 'purchase']);

// Routes publiques pour la liste et le détail des cours
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::get('/notes', [NoteController::class, 'index']);
    Route::patch('/progressions', [ProgressionController::class, 'update']);
    Route::get('/progressions', [ProgressionController::class, 'index']);
});

Route::middleware(['auth:api', 'admin'])->get('/admin/stats', [AdminController::class, 'stats']); 