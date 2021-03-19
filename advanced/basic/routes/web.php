<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Brand;
use App\Models\HomeAbout;
use App\Models\Multipic;
use App\Models\Slider;
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


Route::get('/', function () {
    $brands = Brand::all();
    $abouts = HomeAbout::first();
    $images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'images'));
});

Route::get('/home', function () {
    echo 'This is home page';
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');


// Category Controller
Route::get('/category/all', [CategoryController::class, 'allCat']) -> name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat']) -> name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/edit/{id}', [CategoryController::class, 'update']) -> name('edit.category');
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDelete']) -> name('delete.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']) -> name('restore.category');
Route::get('/pdelete/category/{id}', [CategoryController::class, 'pDelete']) -> name('p_delete.category');

// Brand Controller
Route::get('/brand/all', [BrandController::class, 'allBrand']) -> name('all.brand');
Route::post('/brand/all', [BrandController::class, 'storeBrand']) -> name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);
Route::get('/multi/image', [BrandController::class, 'multiPic']) -> name('multi.image');
Route::post('/multi/addd', [BrandController::class, 'storeImg']) -> name('store.image');

// Home Controller
Route::get('/home/slider', [HomeController::class, 'homeSlider']) -> name('home.slider');
Route::get('/add/slider', [HomeController::class, 'addSlider']) -> name('add.slider');
Route::post('/store/slider', [HomeController::class, 'storeSlider']) -> name('store.slider');
Route::get('/edit/slider/{id}', [HomeController::class, 'editSlider']) -> name('edit.slider');
Route::post('/update/slider/{id}', [HomeController::class, 'updateSlider']) -> name('update.slider');
Route::get('/delete/slider/{id}', [HomeController::class, 'deleteSlider']) -> name('delete.slider');

Route::get('/portfolio', [HomeController::class, 'portfolio']) -> name('portfolio');

// About Controller
Route::get('/home/about', [AboutController::class, 'homeAbout']) -> name('home.about');
Route::get('/add/about', [AboutController::class, 'addAbout']) -> name('add.about');
Route::post('/store/about', [AboutController::class, 'storeAbout']) -> name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'editAbout']) -> name('edit.about');
Route::post('/update/about/{id}', [AboutController::class, 'updateAbout']) -> name('update.about');
Route::get('/delete/about/{id}', [AboutController::class, 'deleteAbout']) -> name('delete.about');

// Contact Controller
Route::get('/home/contact', [ContactController::class, 'homeContact']) -> name('home.contact');
Route::get('/add/contact', [ContactController::class, 'addContact']) -> name('add.contact');
Route::post('/store/contact', [ContactController::class, 'storeContact']) -> name('store.contact');
Route::get('/edit/contact/{id}', [ContactController::class, 'editContact']) -> name('edit.contact');
Route::post('/update/contact/{id}', [ContactController::class, 'updateContact']) -> name('update.contact');
Route::get('/delete/contact/{id}', [ContactController::class, 'deleteContact']) -> name('delete.contact');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users') -> get();

    // return view('dashboard', compact('users'));
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'logout']) -> name('user.logout');


