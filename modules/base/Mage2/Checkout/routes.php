<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 checkout Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 checkout modules.
  | It's a breeze. Simply tell mage2 checkout module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web','website'], 'namespace' => "Mage2\Checkout\Controllers"], function () {


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

});
