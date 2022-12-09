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

Route::get('/', "ProductController@index")->name("home");
Route::get('/products/{id}', "ProductController@show")->name('products.show');
Route::get('/brands', "BrandController@index")->name("brands.list");
Route::get('/brands/{brand}', "BrandController@brandProducts")->name("brands.products");

Route::get('/login', 'AuthController@loginView')->name("auth.login");
Route::post('/login', 'AuthController@login')->name("auth.login-post");

Route::group(['middleware' => "client-auth"], function () {
    Route::post('/logout', 'AuthController@logout')->name("auth.logout");
    Route::get('cart', 'CartController@getCart')->name('cart.get');
    Route::post('cart', 'CartController@addItem')->name('cart.add-item');
    Route::delete('cart', 'CartController@removeItem')->name('cart.remove-item');
    Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');
});
