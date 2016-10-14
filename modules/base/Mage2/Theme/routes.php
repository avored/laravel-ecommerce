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
Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\Theme\Controllers\Admin"], function () {

    Route::get('/admin/themes', ['as' => 'admin.theme.index','uses' => 'ThemeController@index']);

    Route::get('/admin/themes/create', ['as' => 'admin.theme.create','uses' => 'ThemeController@create']);
    Route::post('/admin/themes', ['as' => 'admin.theme.store','uses' => 'ThemeController@store']);
});
