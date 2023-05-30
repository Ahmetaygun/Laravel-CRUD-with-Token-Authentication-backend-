<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);

Route::get('/posts', [PostController::class, 'index']);
Route::post('/store', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
// Örneğin, '/logout/user' rotası yerine '/users/logout' gibi bir yapı kullanılabilir
Route::post('/users/logout', [UserController::class, 'logout']);

// Örneğin, '/logout/admin' rotası yerine '/admins/logout' gibi bir yapı kullanılabilir
Route::post('/admin/logout', [AdminController::class, 'logout']);

// Örneğin, '/posts/delete-selected' rotası yerine '/posts/delete-selected' gibi bir yapı kullanılabilir
Route::post('/posts/delete-selected', [PostController::class, 'delete_selected_post']);

// Örneğin, '/posts/search/{mail}' rotası yerine '/posts/search?mail={mail}' gibi bir yapı kullanılabilir
Route::get('/posts/search', [PostController::class, 'search']);

// ...
