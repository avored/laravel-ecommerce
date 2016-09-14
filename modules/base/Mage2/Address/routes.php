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
Route::group(['middleware' => ['web', 'adminauth','website'], 'namespace' => "Mage2\Address\Controllers"], function () {


});



Route::group(['middleware' => ['frontauth','web','website']], function () {

  Route::resource('/my-account/address', 'AddressController', ['names' => [
      'index' => 'my-account.address.index',
      'create' => 'my-account.address.create',
      'store' => 'my-account.address.store',
      'edit' => 'my-account.address.edit',
      'update' => 'my-account.address.update',
      'destroy' => 'my-account.address.destroy',
  ]]);


});
