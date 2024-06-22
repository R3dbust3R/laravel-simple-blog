<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialController;



Route::get('/', [PostController::class, 'index'])->name('post.index');

Route::resource('user', UserController::class);
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/check-login', [UserController::class, 'checkLogin'])->name('user.check-login');

Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
Route::get('/post/like/{post}', [LikeController::class, 'like'])->name('post.like');
Route::resource('post', PostController::class);

Route::resource('comment', CommentController::class);

Route::get('/social/edit', [SocialController::class, 'edit'])->name('social.edit');
Route::post('/social/store', [SocialController::class, 'store'])->name('social.store');