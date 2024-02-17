<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/posts', [DashboardController::class, 'api_index']);
Route::get('/posts/sort-by-like', [DashboardController::class, 'api_sortByLike'])->name('sort-by-like');
Route::get('/posts/sort-by-newest', [DashboardController::class, 'api_sortByNewest'])->name('sort-by-newest');
Route::get('/posts/{post}', [DashboardController::class, 'api_show'])->name('show-post');

Route::get('/profile/{id}', [ProfileController::class, 'api_profile'])->name('profile-page');