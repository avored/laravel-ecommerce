<?php
/*
  |--------------------------------------------------------------------------
  | Mage2 Install Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 install modules.
  | It's a breeze. Simply tell mage2 install module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => 'web', 'namespace' => "Mage2\Install\Controllers"], function () {

    Route::get('/install', ['as' => 'mage2.install', 'uses' => 'InstallController@index']);

    Route::get('/install/database', ['as' => 'mage2.install.database.get', 'uses' => 'InstallController@databaseGet']);
    Route::post('/install', ['as' => 'mage2.install.database.post', 'uses' => 'InstallController@databasePost']);

    Route::get('/install/admin', ['as' => 'mage2.install.admin', 'uses' => 'InstallController@admin']);
    Route::post('/install/admin', ['as' => 'mage2.install.admin.post', 'uses' => 'InstallController@adminPost']);

    Route::get('/install/success', ['as' => 'mage2.install.success', 'uses' => 'InstallController@success']);


});
