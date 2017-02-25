<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Contact us Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 contact us modules.
  | It's a breeze. Simply tell mage2 contact us module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web'], 'namespace' => "Mage2\ContactUs\Controllers"], function () {
    Route::get('/contact-us', ['as' => 'contact-us.get', 'uses' => 'ContactUsController@getContactUs']);
    Route::post('/contact-us', ['as' => 'contact-us.post', 'uses' => 'ContactUsController@postContactUs']);
});
