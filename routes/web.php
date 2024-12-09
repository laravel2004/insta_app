<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserProfile;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/user-profile', [UserProfile::class, 'index'])->name('user-profile');
    Route::post('/user-profile/update', [UserProfile::class, 'update'])->name('user-profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
