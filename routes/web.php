<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index']);


// Create and store new user
Route::post('/register', [UserController::class, 'store'])->name('register.user');

// Show register form
Route::get('/register', [UserController::class, 'registerForm'])->name('show.register')->middleware('guest');

// Show single user posts
Route::get('/user/posts/{user:full_name}', [UserPostController::class, 'index'])->name('user.posts');

// Show login form
Route::get('/login', [UserController::class, 'loginForm'])->name('show.login');

// Login user
Route::post('/login', [UserController::class, 'login'])->name('login.user');

// Logut user
Route::post('/logout', [UserController::class, 'logout'])->name('logout.user')->middleware('auth');

// Create post
Route::post('/posts', [PostController::class, 'create'])->name('create.post')->middleware('auth');

// Show edit post
Route::get('/posts/edit/{post}', [PostController::class, 'showEdit'])->name('show.edit.post')->middleware('auth');

// Edit post
Route::put('/posts/edit/{post}', [PostController::class, 'edit'])->name('edit.post')->middleware('auth');

// Delete post
Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->name('delete.post')->middleware('auth');

// Like post
Route::post('/posts/likes/{post}', [LikeController::class, 'store'])->name('posts.likes')->middleware('auth');

// Delete post
Route::delete('/posts/likes/{post}', [LikeController::class, 'destroy'])->name('unlike.post')->middleware('auth');
