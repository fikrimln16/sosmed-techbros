<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiUserAuthController;

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/posts', [ApiPostController::class, 'index']);
   Route::post('/posts', [ApiPostController::class, 'store']);
   Route::get('/posts/sort-by-newest', [ApiPostController::class, 'sortByNewest']);
   Route::get('/posts/sort-by-likes', [ApiPostController::class, 'sortByLikes']);
   // Route::get('/posts/{post}', [ApiUserController::class, 'api_show'])->name('show-post');
   // Route::get('/profile/{id}', [ProfileController::class, 'api_profile'])->name('profile-page');
});

Route::post('/login', [ApiUserAuthController::class, 'login']);