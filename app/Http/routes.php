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

Route::get('/', 'HomeController@index');
Route::get('/material', 'HomeController@material');
Route::get('/home', 'HomeController@index');
Route::get('/add-to-cart/{id}', 'CartController@addToCart');
Route::get('/cart', 'CartController@index');

Route::get('/checkout/step1', 'CheckoutController@step1');
Route::post('/checkout/step2', 'CheckoutController@step2');
Route::post('/checkout/step3', 'CheckoutController@step3');
Route::post('/checkout/step4', 'CheckoutController@step4');
Route::post('/checkout/step5', 'CheckoutController@step5');
Route::post('/checkout/step6', 'CheckoutController@step6');
Route::post('/checkout/step7', 'CheckoutController@step7');

Route::post('/cart/action', 'CartController@action');

Route::get('/checkout', 'OrderController@checkoutPage');
Route::get('/checkout/order-successfull', 'OrderController@success');
Route::post('/checkout/place-order', 'OrderController@placeOrder');

Route::get('/product/{id}', 'ProductController@view');

Route::get('/customer/login', 'Customer\AuthController@showLoginForm');
Route::post('/customer/login', 'Customer\AuthController@login');
Route::get('/customer/logout', 'Customer\AuthController@logout');

// Registration Routes...
Route::get('/customer/register', 'Customer\AuthController@showRegistrationForm');
Route::post('/customer/register', 'Customer\AuthController@register');

Route::get('/my-account',   'MyAccountController@index');

Route::get('/my-account/edit',  'MyAccountController@edit');
Route::post('/my-account/edit', 'MyAccountController@update');

Route::get('/my-account/address/create',    'MyAccountController@addressCreate');
Route::post('/my-account/address/',          'MyAccountController@addressStore');

Route::get('/my-account/address/{id}/edit',    'MyAccountController@addressEdit');
Route::put('/my-account/address/{id}',          'MyAccountController@addressUpdate');


Route::group(['prefix' => '/admin'], function() {
    Route::auth();



    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'AdminController@index');

        Route::resource('/product', 'ProductController');
        Route::resource('/order', 'OrderController');
        Route::resource('/page', 'PageController');
    });
});



