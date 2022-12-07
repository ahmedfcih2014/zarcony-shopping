<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@loginView')->name("login");
Route::post('/login', 'AuthController@login')->name("login-post");
Route::post('/logout', 'AuthController@logout')->name("logout");

Route::group(['middleware' => "admin-auth"], function () {
    Route::get("/", "HomeController@index")->name("home");
    Route::resource("products", "ProductController");
});
