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

Route::group(['middleware' => ['web', 'adminauth', 'website','permission'], 'namespace' => "Mage2\Address\Controllers\Admin"], function () {
    Route::get('/admin/configuration/address', ['as' => 'admin.configuration.address', 'uses' => 'ConfigurationController@getConfiguration']);
});



Route::group(['middleware' => ['frontauth', 'web', 'website'],  'namespace' => "Mage2\Address\Controllers"], function () {
    Route::resource('/my-account/address', 'AddressController', ['names' => [
      'index'   => 'my-account.address.index',
      'create'  => 'my-account.address.create',
      'store'   => 'my-account.address.store',
      'edit'    => 'my-account.address.edit',
      'update'  => 'my-account.address.update',
      'destroy' => 'my-account.address.destroy',
  ]]);
});
