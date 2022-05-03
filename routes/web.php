<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
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
    return redirect(route('login'));
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
    Route::resource('products', ProductController::class)->except(['show', 'update']);
});
