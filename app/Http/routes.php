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
Route::group(['middleware' => 'website'], function () {


    Route::get('/', ['as' => 'home','uses' => 'HomeController@index']);

    Route::get('/category/{id}', ['as' => 'category.view', 'uses' => 'CategoryViewController@view']);
    Route::get('/product/{id}', ['as' => 'product.view', 'uses' => 'ProductViewController@view']);

    Route::get('/wishlist/add/{id}', ['as' => 'wishlist.add', 'uses' => 'WishlistController@add']);
    Route::get('/my-account/wishlist', ['as' => 'wishlist.list', 'uses' => 'WishlistController@mylist']);
    Route::get('/wishlist/remove/{id}', ['as' => 'wishlist.remove', 'uses' => 'WishlistController@remove']);

    Route::get('/add-to-cart/{id}', ['as' => 'cart.add-to-cart', 'uses' => 'CartController@addToCart']);
    
    Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);
    Route::put('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);
    Route::get('/cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);

    Route::get('/checkout', ['as' => 'checkout.index', 'uses' => 'CheckoutController@index']);
    Route::post('/checkout/step/user', ['as' => 'checkout.user.post', 'uses' => 'CheckoutController@postUser']);

    Route::get('/checkout/step/shipping-address', ['as' => 'checkout.step.shipping-address', 'uses' => 'CheckoutController@shippingAddress']);
    Route::post('/checkout/step/shipping-address', ['as' => 'checkout.shipping-address.post', 'uses' => 'CheckoutController@postShippingAddress']);

    Route::get('/checkout/step/billing-address', ['as' => 'checkout.step.billing-address', 'uses' => 'CheckoutController@billingAddress']);
    Route::post('/checkout/step/billing-address', ['as' => 'checkout.billing-address.post', 'uses' => 'CheckoutController@postBillingAddress']);

    Route::get('/checkout/step/shipping-option', ['as' => 'checkout.step.shipping-option', 'uses' => 'CheckoutController@shippingOption']);
    Route::post('/checkout/step/shipping-option', ['as' => 'checkout.shipping-option.post', 'uses' => 'CheckoutController@postShippingOption']);


    Route::get('/checkout/step/payment-option', ['as' => 'checkout.step.payment-option', 'uses' => 'CheckoutController@paymentOption']);
    Route::post('/checkout/step/payment-option', ['as' => 'checkout.payment-option.post', 'uses' => 'CheckoutController@postPaymentOption']);

    Route::get('/checkout/step/review', ['as' => 'checkout.step.review', 'uses' => 'CheckoutController@review']);

    Route::get('/order', ['as' => 'order.index', 'uses' => 'OrderController@index']);
    Route::get('/order/success/{id}', ['as' => 'order.success', 'uses' => 'OrderController@success']);


    Route::group(['middleware' => ['frontauth']], function () {

        Route::get('/my-account', ['as' => 'my-account.home', 'uses' => 'MyAccountController@home']);
        Route::get('/my-account/edit', ['as' => 'my-account.edit', 'uses' => 'MyAccountController@edit']);
        Route::post('/my-account/edit', ['as' => 'my-account.store', 'uses' => 'MyAccountController@store']);

        Route::resource('/my-account/address', 'AddressController');
    });

    Route::get('/login', ['as' => 'front.login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('/login', ['as' => 'front.logincheck', 'uses' => 'Auth\AuthController@login']);
    Route::get('/logout', ['as' => 'front.logout', 'uses' => 'Auth\AuthController@logout']);

    Route::get('/register', ['as' => 'front.register', 'uses' => 'Auth\AuthController@getRegister']);
    Route::post('/register', ['as' => 'front.registercheck', 'uses' => 'Auth\AuthController@postRegister']);

});
