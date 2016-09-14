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
Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\TaxClass\Controllers"], function () {

    Route::resource('/admin/tax-class', 'TaxClassController', ['names' => [
            'index' => 'admin.tax-class.index',
            'create' => 'admin.tax-class.create',
            'store' => 'admin.tax-class.store',
            'edit' => 'admin.tax-class.edit',
            'update' => 'admin.tax-class.update',
            'destroy' => 'admin.tax-class.destroy',
    ]]);
});
