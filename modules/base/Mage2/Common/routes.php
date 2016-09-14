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
Route::group(['middleware' => ['web','website'],'namespace' => "Mage2\Common\Controllers"], function () {


    Route::get('/', ['as' => 'home','uses' => 'HomeController@index']);


    Route::get('/admin', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);

    Route::get('/admin/login', ['as' => 'admin.login', 'uses' => 'AdminLoginController@showLoginForm']);
    Route::post('/admin/login', ['as' => 'admin.login.post', 'uses' => 'AdminLoginController@login']);
    
    Route::get('/admin/logout', ['as' => 'admin.logout', 'uses' => 'AdminLoginController@logout']);


    Route::get('/login', ['as' => 'front.login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('/login', ['as' => 'front.logincheck', 'uses' => 'LoginController@login']);
    Route::get('/logout', ['as' => 'front.logout', 'uses' => 'LoginController@logout']);

    Route::get('/register', ['as' => 'front.register', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('/register', ['as' => 'front.registercheck', 'uses' => 'RegisterController@register']);

    //Route::post('/admin/logout', ['as' => 'admin.logout', 'uses' => 'AuthController@logout']);

    //Route::group(['middleware' => 'adminauth'], function () {
    //    Route::get('/admin', ['as' => 'admin.index', 'uses' => 'HomeController@index']);
    //    
    //    Route::resource('/admin/page', 'PageController');
    //});
});
