<?php

use App\Models\Address;
use App\Models\User;
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

Route::get('/insert', function () {
    $user = User::findOrFail(1);
    $address = new Address(['name' => '1234 LA']);
    echo $user -> address();
    $user -> address() -> save($address);
    return $user -> address();
});


Route::get('/update', function () {
    $address = Address::whereUserId(1) -> first();
    $address->name = "4321 updated";
    $address->save();
    return $address;
});

Route::get('/read', function () {
    $user = User::findOrFail(1);
    return $user->address->name;
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);
    return $user->address->delete();
});
