<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Addres Module Routes
  |--------------------------------------------------------------------------
  |h
  | Here is where you can register all of the routes for an mage2 address modules.
  | It's a breeze. Simply tell mage2 adddress module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\Dashboard\Controllers\Admin"], function () {
    Route::get('/admin', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
});



Route::group(['middleware' => ['web', 'website'],  'namespace' => "Mage2\Dashboard\Controllers"], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});
