<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('throttle:only_ten_visits')->group(function (){
   Route::post('/posts', [DashboardController::class, 'store'])->name('textarea-post.form');
   Route::post('/comment/{post}', [CommentController::class, 'comment'])->name('comment-post'); 
});

Route::get('/posts', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/posts/sort-by-like', [DashboardController::class, 'sortByLike'])->name('sort-by-like');
Route::get('/posts/sort-by-newest', [DashboardController::class, 'sortByNewest'])->name('sort-by-newest');
Route::get('/posts/{post}', [DashboardController::class, 'show'])->name('show-post');
Route::post('/like/{id}', [DashboardController::class, 'like'])->name('like-post');

#Register Login
Route::get('/register', [AuthController::class, 'show_register'])->name('register-page');
Route::post('/register', [AuthController::class, 'store_register'])->name('store-register');
Route::get('/login', [AuthController::class, 'show'])->name('login-page');
Route::post('/login', [AuthController::class, 'login'])->name('login');

#OAuth
Route::get('/auth/github', [AuthController::class, 'redirect'])->name('redirect-github');
Route::get('/auth/github/callback', [AuthController::class, 'handleCallback'])->name('github-callback');

#Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

#Profile
Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile-page');