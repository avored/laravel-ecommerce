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
Route::group(['middleware' => ['web','website'], 'namespace' => "Mage2\Cart\Controllers"], function () {

  Route::get('/add-to-cart/{id}', ['as' => 'cart.add-to-cart', 'uses' => 'CartController@addToCart']);

  Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);
  Route::put('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);
  Route::get('/cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);


});
