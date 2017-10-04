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
  | Mage2 E commerce Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 user modules.
  | It's a breeze. Simply tell mage2 user module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */


Route::middleware(['web'])
    ->prefix('admin')
    ->namespace('Mage2\Ecommerce\Http\Controllers\Admin')
    ->group(function () {

        Route::get('login', ['as' => 'admin.login', 'uses' => 'LoginController@loginForm']);
        Route::post('login', ['as' => 'admin.login.post', 'uses' => 'LoginController@login']);

        Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

        Route::get('/password/reset/{token}', ['as' => 'admin.password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
        Route::post('/password/email', ['as' => 'admin.password.email.post', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);

        Route::post('/password/reset', ['as' => 'admin.password.reset.token', 'uses' => 'ResetPasswordController@reset']);

        Route::get('/password/reset', ['as' => 'admin.password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);


    });


Route::middleware(['web', 'admin.auth'])
    ->prefix('admin')
    ->namespace('Mage2\Ecommerce\Http\Controllers\Admin')
    ->group(function () {

        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);


        Route::resource('/product', 'ProductController', ['as' => 'admin']);
        Route::resource('/category', 'CategoryController', ['as' => 'admin']);

        Route::post('/product-image/upload', ['as' => 'admin.product.upload-image',
            'uses' => 'ProductController@uploadImage']);
        Route::post('/product-image/delete', ['as' => 'admin.product.delete-image',
            'uses' => 'ProductController@deleteImage']);

        Route::get('/checkout', ['as' => 'checkout.index', 'uses' => 'CheckoutController@index']);
    });
