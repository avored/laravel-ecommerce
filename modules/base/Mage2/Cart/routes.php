<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Cart Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 cart modules.
  | It's a breeze. Simply tell mage2 cart module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\Cart\Controllers"], function () {
    Route::get('/add-to-cart/{id}', ['as' => 'cart.add-to-cart', 'uses' => 'CartController@addToCart']);

    Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);
    Route::put('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);
    Route::get('/cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
});
