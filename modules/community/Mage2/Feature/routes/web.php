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
Route::group(['middleware' => ['web'], 'namespace' => "Mage2\Feature\Controllers"], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});
