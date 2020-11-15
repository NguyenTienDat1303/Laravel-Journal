<?php

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

Route::get('/', function () {
    return "I am Dat";
});

Route::get('/about', function () {
    return "Hi about page";
});

Route::get('/contact', function () {
    return "Hi contact";
});

Route::get('/post/{id}', function ($id) {
    return "Hi id $id";
});

Route::get('/admin/post/example', array('as' => 'admin.home', function () {
    $url = route('admin.home');
    return "this url is ".$url;
}));

