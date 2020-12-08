<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
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

Route::get('/insert', function() {
    DB::insert('insert into posts(title, body, is_admin) value(?, ?, ?)', ['Php Laravel 1', 'Laravel is cool', 1]);
});

Route::get('/read', function() {
    $results = DB::select('select * from posts where id = ?', ['*']);
    foreach ($results as $post) {
        return $post -> title;
    }
    // return $result;
});

Route::get('/update', function() {
    $results = DB::update('update posts set title = "Update title" where id = ?', [2]);
    return $results;
});

Route::get('/delete', function() {
    $results = DB::delete('delete from posts where id = ?', [2]);
    return $results;
});