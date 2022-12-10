<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@loginView')->name("login");
Route::post('/login', 'AuthController@login')->name("login-post");

Route::group(['middleware' => "admin-auth"], function () {
    Route::get("/", "HomeController@index")->name("home");
    Route::resource("products", "ProductController");
    Route::resource("brands", "BrandController");
    Route::resource("users", "UserController");
    Route::get("orders", "OrderController@index")->name("orders.index");
    Route::get("orders/{order}", "OrderController@show")->name("orders.show");
    Route::post("orders/{order}/change-state", "OrderController@changeState")->name("orders.change-state");

    Route::post('/logout', 'AuthController@logout')->name("logout");
});
