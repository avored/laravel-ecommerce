<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Tax Class Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 tax class modules.
  | It's a breeze. Simply tell mage2 tax class module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'adminauth'], 'namespace' => "Mage2\TaxClass\Controllers\Admin"], function () {

    Route::resource('/admin/tax-rule', 'TaxRuleController', ['as' => 'admin']);

    Route::get('/admin/configuration/tax-class', ['as' => 'admin.configuration.tax-class', 'uses' => 'ConfigurationController@getConfiguration']);
});