<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/posts', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/posts', [DashboardController::class, 'store'])->name('textarea-post.form');
Route::get('/posts/{post}', [DashboardController::class, 'show'])->name('show-post');
Route::post('/like/{id}', [DashboardController::class, 'like'])->name('like-post');

Route::post('/comment/{post}', [CommentController::class, 'comment'])->name('comment-post');

Route::get('/register', [AuthController::class, 'show_register'])->name('register-page');
Route::post('/register', [AuthController::class, 'store_register'])->name('store-register');
Route::get('/login', [AuthController::class, 'show'])->name('login-page');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('redirect-google');
Route::get('/login/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google-callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile-page');