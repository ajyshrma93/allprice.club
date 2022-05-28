<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect(route('search', 'grid'));
});
Auth::routes();
Route::get('login/{id}', [LoginController::class, 'loginById'])->name('loginById');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('googleLogin');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


//// logged in user routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return redirect(route('products.index'));
    })->name('home');

    //// category routes
    Route::post('catgeory/ajax-update', [CategoryController::class, 'ajaxUpdate'])->name('category.ajax-update');
    Route::post('catgeory/ajax-add', [CategoryController::class, 'ajaxAdd'])->name('category.ajax-add');
    Route::resource('category', CategoryController::class)->except(['create', 'show', 'update']);

    ///// shop routes
    Route::post('shops/ajax-update', [ShopController::class, 'ajaxUpdate'])->name('shops.ajax-update');
    Route::resource('shops', ShopController::class)->except(['show', 'update']);
    /// Product routes
    Route::post('products/bulk-upload', [ProductController::class, 'bulkUpload'])->name('products.bulk-upload');
    Route::post('products/ajax-update', [ProductController::class, 'ajaxUpdate'])->name('products.ajax-update');
    Route::post('products/clone', [ProductController::class, 'clone'])->name('products.clone');
    Route::resource('products', ProductController::class)->except(['show', 'update']);
    Route::post('user-compare-location', [HomeController::class, 'compareLocation'])->name('user.compare.location');
    Route::post('user-update-location', [HomeController::class, 'updateLocation'])->name('user.update.location');

    Route::group(['middleware' => 'is_admin'], function () {
        Route::post('cities/list', [CityController::class, 'getList'])->name('cities.list');
        Route::post('cities/update', [CityController::class, 'update'])->name('cities.update');
        Route::resource('cities', CityController::class)->except('update', 'edit', 'destroy');
    });
});
Route::any('search/filter-products', [SearchController::class, 'filter'])->name('filter-products');
Route::get('search/{type}', [SearchController::class, 'index'])->name('search');
Route::get('geo-location', [HomeController::class, 'getLocation']);
//Route::view('test', 'geolocation');
Route::get('clear-cache', function () {
    $exitCode = \Artisan::call('cache:clear');
});
