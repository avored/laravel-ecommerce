<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/add-to-cart/{id}', 'CartController@addToCart');
Route::get('/cart', 'CartController@index');
Route::post('/cart/action', 'CartController@action');
Route::get('/checkout', 'OrderController@index');
Route::post('/checkout/place-order', 'OrderController@placeOrder');



Route::group(['prefix' => '/admin'], function() {
    Route::auth();



    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'AdminController@index');

        Route::resource('/product','ProductController');
    });

});



