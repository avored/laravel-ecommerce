<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */


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
Route::group(['middleware' => ['web', 'install'], 'namespace' => "Mage2\Checkout\Controllers"], function () {
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
