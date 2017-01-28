<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Theme  Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 System  modules.
  | It's a breeze. Simply tell mage2 theme  module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\System\Controllers"], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});


Route::group(['middleware' => ['web', 'adminauth', 'website', 'permission'], 'namespace' => "Mage2\System\Controllers\Admin"], function () {

    Route::get('/admin/configuration/general', ['as' => 'admin.configuration.general', 'uses' => 'ConfigurationController@getGeneralConfiguration']);

    Route::get('/admin/configuration', ['as' => 'admin.configuration', 'uses' => 'ConfigurationController@index']);
    Route::post('/admin/configuration', ['as' => 'admin.configuration.store', 'uses' => 'ConfigurationController@store']);


    Route::get('/admin', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

    Route::get('/admin/module', ['as' => 'admin.module.index', 'uses' => 'ModuleController@index']);

    Route::get('/admin/module/create', ['as' => 'admin.module.create', 'uses' => 'ModuleController@create']);
    Route::post('/admin/module', ['as' => 'admin.module.store', 'uses' => 'ModuleController@store']);
    
    Route::post('/admin/module/install/{identifier}', ['as' => 'admin.module.install', 'uses' => 'ModuleController@install']);
    Route::post('/admin/module/uninstall/{identifier}', ['as' => 'admin.module.uninstall', 'uses' => 'ModuleController@uninstall']);

    Route::get('/admin/themes', ['as' => 'admin.theme.index', 'uses' => 'ThemeController@index']);

    Route::get('/admin/themes/create', ['as' => 'admin.theme.create', 'uses' => 'ThemeController@create']);
    Route::post('/admin/themes', ['as' => 'admin.theme.store', 'uses' => 'ThemeController@store']);

    Route::post('/admin/themes/{name}', ['as' => 'admin.theme.activate', 'uses' => 'ThemeController@activate']);

    Route::delete('/admin/themes/{name}', ['as' => 'admin.theme.destroy', 'uses' => 'ThemeController@destroy']);
});




