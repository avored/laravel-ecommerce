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
Route::group(['middleware' => ['web', 'adminauth', 'website','permission'], 'namespace' => "Mage2\System\Controllers\Admin"], function () {
    
    Route::get('/admin/module', ['as' => 'admin.module.index', 'uses' => 'ModuleController@index']);

    Route::get('/admin/module/create', ['as' => 'admin.module.create', 'uses' => 'ModuleController@create']);
    Route::post('/admin/module', ['as' => 'admin.module.store', 'uses' => 'ModuleController@store']);


});
