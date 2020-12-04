<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/post/{id}', [PostController::class, 'index']);
Route::resource('posts', PostController::class);

Route::get('/contact', [PostController::class, 'contact']);

Route::get('/post/{id}/{name}/{password}', [PostController::class, 'show_post']);
