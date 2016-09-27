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
Route::group(['middleware' => ['web', 'website', 'frontauth'], 'namespace' => "Mage2\Paypal\Controllers"], function () {
    Route::get('/checkout/paypal/store', ['as' => 'paypal.store', 'uses' => 'PaypalController@store']);
    Route::get('/checkout/paypal/cancel', ['as' => 'paypal.cancel', 'uses' => 'PaypalController@cancel']);
});
