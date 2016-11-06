<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Paypal Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 paypal modules.
  | It's a breeze. Simply tell mage2 paypal module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web', 'website', 'adminauth','permission'], 'namespace' => "Mage2\Paypal\Controllers\Admin"], function () {
    Route::get('/admin/configuration/paypal', ['as' => 'admin.configuration.paypal', 'uses' => 'ConfigurationController@getConfiguration']);
});

Route::group(['middleware' => ['web', 'website', 'frontauth'], 'namespace' => "Mage2\Paypal\Controllers"], function () {
    Route::get('/checkout/paypal/store', ['as' => 'paypal.store', 'uses' => 'PaypalController@store']);
    Route::get('/checkout/paypal/cancel', ['as' => 'paypal.cancel', 'uses' => 'PaypalController@cancel']);
});

