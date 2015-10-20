<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */




/**
 * FRONT ROUTES
 *
 */

Route::get('/', 'IndexController@home');

Route::get('/category/{slug}',  ['as' => 'category.view', 'uses' => 'CategoryController@view']);
Route::get('/product/{slug}',   ['as' => 'product.view', 'uses' => 'ProductController@view']);
Route::post('/cart/addtocart/{id}', 'CartController@addtocart');
Route::get('/cart', 'CartController@index');
Route::get('/checkout', 'CheckoutController@index');
Route::post('/order', 'OrderController@index');


/**
 * ADMIN ROUTES
 *
 */


Route::get('/admin/login', 'Admin\AuthController@getlogin');
Route::get('/admin/logout', 'Admin\AuthController@getLogout');

Route::post('/admin/login', 'Admin\AuthController@postLogin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin','Admin\IndexController@index');

    Route::resource('/admin/pages','Admin\PagesController');
    Route::resource("/admin/product", "Admin\ProductController");
    Route::resource("/admin/category", "Admin\CategoryController");

    Route::get('/admin/user/edit-account','Admin\UserController@editAccount');
    Route::patch('/admin/user/edit-account','Admin\UserController@update');
    Route::post('/admin/product/uploadImage', "Admin\ProductController@uploadProductImage");
});

