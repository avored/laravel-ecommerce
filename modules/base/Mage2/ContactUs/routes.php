<?php

/*
  |--------------------------------------------------------------------------
  | Review Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\ContactUs\Controllers"], function () {
    Route::get('/contact-us', ['as' =>'contact-us.get', 'uses' => 'ContactUsController@getContactUs']);
    Route::post('/contact-us', ['as' =>'contact-us.post', 'uses' => 'ContactUsController@postContactUs']);

});