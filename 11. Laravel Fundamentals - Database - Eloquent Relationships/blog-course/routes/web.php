<?php

use App\Http\Controllers\PostController;
use App\Models\Country;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
    DB::insert('insert into posts(title, body, is_admin) value(?, ?, ?)', ['Php Laravel 3', 'Laravel is cool', 1]);
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

//Eloquent

Route::get('/e-read', function() {
    $post = Post::all();
    return $post;
});

Route::get('/e-find', function() {
    $post = Post::find(3);
    return $post;
});

Route::get('/e-findwhere', function() {
    $posts = Post::where('id', 1) -> orderBy('id', 'desc') -> take(1) -> get();
    return $posts;
});


Route::get('/e-findmore', function() {
    // $posts = Post::findOrFail(6);
    // return $posts;

    $posts = Post::where('user_count', '<', 50) -> firstOrFail();
    return $posts;
});


Route::get('/e-basic-insert', function() {
    $post = new Post;
    $post -> title = 'new ORM title';
    $post -> body = 'Eloquent content';
    $post -> is_admin = 0;
    $post -> save();
});

Route::get('/e-basic-save', function() {
    $post = Post::find(1);
    $post -> title = 'new ORM 1 title updated';
    $post -> body = 'Eloquent content';
    $post -> is_admin = 0;
    $post -> save();
});

Route::get('/e-create', function() {
    Post::create(['title' => 'The create method', 'body' => 'New Eloquent body', 'is_admin' => 1]);
});

Route::get('/e-update', function() {
    Post::where('id', 1) -> where('is_admin', 0) -> update(['title' => 'Eloquent Updated title', 'body' => 'is updated']);
});


Route::get('/e-delete', function() {
    // Delete one
    $post = Post::destroy(1);
    // Delete more
    Post::destroy([4,5]);
    Post::where('is_admin', 0) -> delete();
});

Route::get('/e-soft-delete', function() {
    $post = Post::destroy(3);
});

Route::get('/e-trash', function() {
    $post = Post::withTrashed() -> get();
    return $post;
});

Route::get('/e-restore', function() {
    $post = Post::withTrashed() -> where('is_admin', 1) -> restore();
    return $post;
});

Route::get('/e-force-delete', function() {
    $post = Post::withTrashed() -> where('is_admin', 0) -> forceDelete();
    return $post;
});

//Relationships

Route::get('/user/{id}/post', function ($id) {
    return User::find($id) -> post;
});

Route::get('/post/{id}/user', function ($id) {
    return Post::find($id) -> user;
});


Route::get('/posts', function () {
    $user = User::find(1);

    foreach($user -> posts as $post) {
       echo  $post -> title . '<br>';
    }
    // return $user;
});

Route::get('/user/{id}/roles', function ($id) {
    $roles = User::find($id) -> roles;
    return $roles;
});

Route::get('/user/{id}/pivot', function ($id) {
    $user = User::find($id);
    foreach($user->roles as $role){
        echo $role -> pivot;
    }
});

Route::get('/user/country', function () {
    $country = Country::find(4);
    foreach($country->posts as $post){
        return $post->title;
    }
});


Route::get('/user/photos', function () {
    $user = User::find(2);
    foreach($user->photos as $photo){
        return $photo;
    }
});

Route::get('/post/photos', function () {
    $post = Post::find(2);
    foreach($post->photos as $photo){
        return $photo;
    }
});

Route::get('/photo/{id}/post', function ($id) {
    $photo = Photo::findOrFail($id);
    $imageable = $photo->imageable;
    return $imageable;
});


Route::get('/post/tag', function () {
    $post = Post::find(1);
    foreach ($post->tags as $tag) {
        echo $tag -> name;
    }
});
Route::get('/tag/post', function () {
    $tag = Tag::find(2);
    foreach($tag->posts as $post){
        echo $post -> title;
    }
});
