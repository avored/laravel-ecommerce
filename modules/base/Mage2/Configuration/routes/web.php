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


Route::group(['middleware' => ['web', 'website', 'adminauth','permission'], 'namespace' => "Mage2\Configuration\Controllers\Admin"], function () {
    Route::get('/admin/configuration', ['as' => 'admin.configuration', 'uses' => 'ConfigurationController@index']);
    Route::post('/admin/configuration', ['as' => 'admin.configuration.store', 'uses' => 'ConfigurationController@store']);
});


Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\Configuration\Controllers"], function () {
});
