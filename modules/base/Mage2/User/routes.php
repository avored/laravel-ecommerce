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
Route::group(['middleware' => ['web', 'adminauth','website'], 'namespace' => "Mage2\User\Controllers"], function () {

      Route::resource('/admin/user', 'UserController',['names' => [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'store' => 'admin.user.store',
            'edit' => 'admin.user.edit',
            'update' => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]]);




});
Route::group(['middleware' => ['web', 'frontauth','website'], 'namespace' => "Mage2\User\Controllers"], function () {

    Route::get('/my-account', ['as' => 'my-account.home', 'uses' => 'MyAccountController@home']);
    Route::get('/my-account/edit', ['as' => 'my-account.edit', 'uses' => 'MyAccountController@edit']);
    Route::post('/my-account/edit', ['as' => 'my-account.store', 'uses' => 'MyAccountController@store']);
});
