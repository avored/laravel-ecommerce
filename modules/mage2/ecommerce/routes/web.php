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
    ->namespace('Mage2\Ecommerce\Http\Controllers')
    ->group(function () {

        Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

        //* ***** START MAGE2 CATALOG FRONT ROUTES  *****  */
        Route::get('/category/{slug}',  ['as' => 'category.view',
            'uses' => 'CategoryViewController@view']);
        Route::get('/product/{slug}',   ['as' => 'product.view',
            'uses' => 'ProductViewController@view']);
        Route::get('/product-search',   ['as' => 'search.result',
            'uses' => 'SearchController@result']);

        //* ***** END MAGE2 CATEGORY FRONT ROUTES  *****  */


        //* ***** START MAGE2 CART FRONT ROUTES  *****  */
        Route::post('/add-to-cart', ['as' => 'cart.add-to-cart', 'uses' => 'CartController@addToCart']);

        Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);
        Route::put('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);
        Route::get('/cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);



        Route::get('/wishlist/add/{slug}', ['as' => 'wishlist.add', 'uses' => 'WishlistController@add']);
        Route::get('/my-account/wishlist', ['as' => 'wishlist.list', 'uses' => 'WishlistController@mylist']);
        Route::get('/wishlist/remove/{slug}', ['as' => 'wishlist.remove', 'uses' => 'WishlistController@destroy']);


        Route::get('/checkout', ['as' => 'checkout.index', 'uses' => 'CheckoutController@index']);

        Route::post('/get-code-discount', ['as' => 'get.code-discount', 'uses' => 'GiftCouponController@getCodeDiscount']);


        Route::get('/order', ['as' => 'order.index', 'uses' => 'OrderController@index']);
        Route::get('/order/success/{id}', ['as' => 'order.success', 'uses' => 'OrderController@success']);

        Route::get('/my-account/order/list', ['as' => 'my-account.order.list', 'uses' => 'OrderController@myAccountOrderList']);
        Route::get('/my-account/order/{id}/view', ['as' => 'my-account.order.view', 'uses' => 'OrderController@myAccountOrderView']);


        Route::post('/order', ['as' => 'order.place', 'uses' => 'OrderController@place']);

        Route::post('/tax-calculation', ['as' => 'tax.calculation', 'uses' => 'TaxRuleController@getTaxAmount']);

        Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'login.post', 'uses' => 'LoginController@login']);
        Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

        Route::get('/password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
        Route::post('/password/reset', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@reset']);

        Route::get('/password/reset', ['as' => 'password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
        Route::post('/password/email', ['as' => 'password.email.post', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);

        Route::get('/register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
        Route::post('/register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);

        Route::post('/order', ['as' => 'order.place', 'uses' => 'OrderController@place']);


        Route::get('/page/{slug}', ['as' => 'page.show',
            'uses' => 'PageController@show'
        ]);



        Route::post('/tax-calculation', ['as' => 'tax.calculation', 'uses' => 'TaxRuleController@getTaxAmount']);


        Route::post('/review', ['as' => 'review.store','uses' => 'ReviewController@store']);
    });


Route::middleware(['web','front.auth'])
    ->namespace('Mage2\Ecommerce\Http\Controllers')
    ->group(function () {

        Route::get('/my-account', ['as' => 'my-account.home', 'uses' => 'MyAccountController@home']);
        Route::get('/my-account/edit', ['as' => 'my-account.edit', 'uses' => 'MyAccountController@edit']);
        Route::post('/my-account/edit', ['as' => 'my-account.store', 'uses' => 'MyAccountController@store']);

        Route::get('/my-account/upload-image', ['as' => 'my-account.upload-image', 'uses' => 'MyAccountController@uploadImage']);
        Route::post('/my-account/upload-image', ['as' => 'my-account.upload-image.post', 'uses' => 'MyAccountController@uploadImagePost']);

        Route::get('/my-account/change-password', ['as' => 'my-account.change-password', 'uses' => 'MyAccountController@changePassword']);
        Route::post('/my-account/change-password', ['as' => 'my-account.change-password.post', 'uses' => 'MyAccountController@changePasswordPost']);


        Route::resource('/my-account/address', 'AddressController', ['as' => 'my-account']);


        Route::get('/order', ['as' => 'order.index', 'uses' => 'OrderController@index']);
        Route::get('/order/success/{id}', ['as' => 'order.success', 'uses' => 'OrderController@success']);

        Route::get('/my-account/order/list', ['as' => 'my-account.order.list', 'uses' => 'OrderController@myAccountOrderList']);
        Route::get('/my-account/order/{id}/view', ['as' => 'my-account.order.view', 'uses' => 'OrderController@myAccountOrderView']);



        Route::get('/wishlist/add/{slug}', ['as' => 'wishlist.add', 'uses' => 'WishlistController@add']);
        Route::get('/my-account/wishlist', ['as' => 'wishlist.list', 'uses' => 'WishlistController@mylist']);
        Route::get('/wishlist/remove/{slug}', ['as' => 'wishlist.remove', 'uses' => 'WishlistController@destroy']);


    });



Route::middleware(['web'])
    ->prefix('admin')
    ->namespace('Mage2\Ecommerce\Http\Controllers\Admin')
    ->group(function () {

        Route::get('login', ['as' => 'admin.login', 'uses' => 'LoginController@loginForm']);
        Route::post('login', ['as' => 'admin.login.post', 'uses' => 'LoginController@login']);

        Route::get('logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

        Route::get('password/reset/{token}', ['as' => 'admin.password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
        Route::post('password/email', ['as' => 'admin.password.email.post', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);

        Route::post('password/reset', ['as' => 'admin.password.reset.token', 'uses' => 'ResetPasswordController@reset']);

        Route::get('password/reset', ['as' => 'admin.password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);


    });


Route::middleware(['web', 'admin.auth'])
    ->prefix('admin')
    ->namespace('Mage2\Ecommerce\Http\Controllers\Admin')
    ->group(function () {



        /**************** ATTRIBUTES ROUTES STARTS ****************/


        /**************** ATTRIBUTES ROUTES ENDS ****************/




        Route::post('/option-combination-modal', [
            'uses' => 'OptionController@optionCombinationModal',
            'as' => 'admin.option.combination',
        ]);

        Route::post('/edit-option-combination-modal', [
            'uses' => 'OptionController@editOptionCombinationModal',
            'as' => 'admin.option.combination.edit',
        ]);

        Route::post('/option-combination-update', [
            'uses' => 'OptionController@optionCombinationUpdate',
            'as' => 'admin.product.option-combination.update',
        ]);




        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

        Route::resource('/role', 'RoleController', ['as' => 'admin']);
        Route::resource('product', 'ProductController', ['as' => 'admin']);
        Route::resource('category', 'CategoryController', ['as' => 'admin']);
        Route::resource('review', 'ReviewController', ['as' => 'admin']);

        Route::resource('/page', 'PageController', ['as' => 'admin']);
        Route::resource('/tax-group', 'TaxGroupController', ['as' => 'admin']);
        Route::resource('/tax-rule', 'TaxRuleController', ['as' => 'admin']);
        Route::resource('/country', 'CountryController', ['as' => 'admin']);
        Route::resource('/state', 'StateController', ['as' => 'admin']);

        Route::resource('/admin-user', 'AdminUserController', ['as' => 'admin']);
        Route::resource('review', 'ReviewController', ['as' => 'admin']);



        Route::post('/product-attribute-panel', ['as' => 'admin.product-attribute.get-attribute', 'uses' => 'AttributeController@getAttribute']);

        Route::resource('/attribute', 'AttributeController', ['as' => 'admin']);


        Route::get('/admin-user-api-show', ['as' => 'admin.admin-user.show.api','uses' => 'AdminUserController@apiShow']);


        Route::post('product-image/upload', ['as' => 'admin.product.upload-image',
            'uses' => 'ProductController@uploadImage']);
        Route::post('product-image/delete', ['as' => 'admin.product.delete-image',
            'uses' => 'ProductController@deleteImage']);

        Route::resource('gift-coupon', 'GiftCouponController', ['as' => 'admin']);


        //Route::get('update-check', ['as' => 'admin.update.check', 'uses' => 'UpdateController@check']);

        Route::get('configuration', ['as' => 'admin.configuration', 'uses' => 'ConfigurationController@index']);
        Route::post('configuration', ['as' => 'admin.configuration.store', 'uses' => 'ConfigurationController@store']);


        //Route::get('themes', ['as' => 'admin.theme.index', 'uses' => 'ThemeController@index']);

        //Route::get('themes/create', ['as' => 'admin.theme.create', 'uses' => 'ThemeController@create']);
        //Route::post('themes', ['as' => 'admin.theme.store', 'uses' => 'ThemeController@store']);

        //Route::post('active-themes/{name}', ['as' => 'admin.theme.activated', 'uses' => 'ThemeController@activated']);

        //Route::post('deactive-themes/{name}', ['as' => 'admin.theme.deactivated', 'uses' => 'ThemeController@deactivated']);

        //Route::delete('themes/{name}', ['as' => 'admin.theme.destroy', 'uses' => 'ThemeController@destroy']);

        Route::resource('order-status', 'OrderStatusController', ['as' => 'admin']);

        Route::get('order', [
                'as' => 'admin.order.index',
                'uses' => 'OrderController@index'
        ]);


        Route::get('order/{id}', ['as' => 'admin.order.view', 'uses' => 'OrderController@view']);
        Route::get('order/{id}/send-email-invoice', ['as' => 'admin.order.send-email-invoice', 'uses' => 'OrderController@sendEmailInvoice']);

        Route::get('order/{id}/change-status', ['as' => 'admin.order.change-status', 'uses' => 'OrderController@changeStatus']);
        Route::put('order/{id}/update-status', ['as' => 'admin.order.update-status', 'uses' => 'OrderController@updateStatus']);


        /*
        Route::get('related-product-get-datatable-data/{id?}',
            ['as' => 'admin.related-product.data-grid-table.get-data',
            'uses' => 'RelatedProductController@getDataGrid'
        ]);
        */


    });
