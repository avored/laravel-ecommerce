<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Theme  Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 theme  modules.
  | It's a breeze. Simply tell mage2 theme  module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'adminauth', 'website','permission'], 'namespace' => "Mage2\Theme\Controllers\Admin"], function () {
    
    Route::get('/admin/themes', ['as' => 'admin.theme.index', 'uses' => 'ThemeController@index']);

    Route::get('/admin/themes/create', ['as' => 'admin.theme.create', 'uses' => 'ThemeController@create']);
    Route::post('/admin/themes', ['as' => 'admin.theme.store', 'uses' => 'ThemeController@store']);

    Route::post('/admin/themes/{name}', ['as' => 'admin.theme.activate', 'uses' => 'ThemeController@activate']);
    
    Route::delete('/admin/themes/{name}', ['as' => 'admin.theme.destroy', 'uses' => 'ThemeController@destroy']);

});
