<?php

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




        Route::post('/review', ['as' => 'review.store','uses' => 'ReviewController@store']);
        Route::post('/get-code-discount', ['as' => 'get.code-discount', 'uses' => 'GiftCouponController@getCodeDiscount']);


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


Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix('admin')
    ->namespace('Mage2\Ecommerce\Http\Controllers\Admin')
    ->group(function () {



        /**************** ATTRIBUTES ROUTES STARTS ****************/


        /**************** ATTRIBUTES ROUTES ENDS ****************/




        Route::post('option-combination-modal', [
            'uses' => 'OptionController@optionCombinationModal',
            'as' => 'admin.option.combination',
        ]);

        Route::post('edit-option-combination-modal', [
            'uses' => 'OptionController@editOptionCombinationModal',
            'as' => 'admin.option.combination.edit',
        ]);

        Route::post('option-combination-update', [
            'uses' => 'OptionController@optionCombinationUpdate',
            'as' => 'admin.product.option-combination.update',
        ]);


        Route::resource('property', 'PropertyController', ['as' => 'admin']);

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


        Route::get('themes', ['as' => 'admin.theme.index', 'uses' => 'ThemeController@index']);

        Route::get('themes/create', ['as' => 'admin.theme.create', 'uses' => 'ThemeController@create']);
        Route::post('themes', ['as' => 'admin.theme.store', 'uses' => 'ThemeController@store']);

        Route::post('active-themes/{name}', ['as' => 'admin.theme.activated', 'uses' => 'ThemeController@activated']);

        Route::post('deactive-themes/{name}', ['as' => 'admin.theme.deactivated', 'uses' => 'ThemeController@deactivated']);

        Route::delete('themes/{name}', ['as' => 'admin.theme.destroy', 'uses' => 'ThemeController@destroy']);

        Route::resource('order-status', 'OrderStatusController', ['as' => 'admin']);

        Route::resource('subscriber', 'SubscriberController', ['as' => 'admin']);

        Route::get('order', [
                'as' => 'admin.order.index',
                'uses' => 'OrderController@index'
        ]);

        Route::post('get-property-element', [
            'as' => 'admin.property.element',
            'uses' => 'PropertyController@getElementHtml'
        ]);

        Route::post('edit-product-variation', [
            'as' => 'admin.variation.edit',
            'uses' => 'ProductController@editVariation'
        ]);

        Route::post('get-attribute-element', [
            'as' => 'admin.attribute.element',
            'uses' => 'AttributeController@getElementHtml'
        ]);


        Route::get('order/{id}', ['as' => 'admin.order.view', 'uses' => 'OrderController@view']);
        Route::get('order/{id}/send-email-invoice', ['as' => 'admin.order.send-email-invoice', 'uses' => 'OrderController@sendEmailInvoice']);

        Route::get('order/{id}/change-status', ['as' => 'admin.order.change-status', 'uses' => 'OrderController@changeStatus']);
        Route::put('order/{id}/update-status', ['as' => 'admin.order.update-status', 'uses' => 'OrderController@updateStatus']);


    });
