<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Attribute Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 attribute modules.
  | It's a breeze. Simply tell mage2 attribute module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\Attribute\Controllers"], function () {
});
