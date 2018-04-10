<?php

/*
  |--------------------------------------------------------------------------
  | AvoRed E commerce Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an avored user modules.
  | It's a breeze. Simply tell avored user module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

$baseAdminUrl = config('avored-ecommerce.admin_url');

Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->namespace('AvoRed\Ecommerce\Http\Controllers\Admin')
    ->group(function () {
        Route::get('login', 'LoginController@loginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');

        Route::get('logout', 'LoginController@logout')->name('logout');

        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email.post');

        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset.token');
    });

Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\Ecommerce\Http\Controllers\Admin')
    ->group(function () {
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

        Route::resource('/page', 'PageController', ['as' => 'admin']);

        Route::resource('/admin-user', 'AdminUserController', ['as' => 'admin']);

        Route::post('/product-attribute-panel', ['as' => 'admin.product-attribute.get-attribute', 'uses' => 'AttributeController@getAttribute']);

        Route::resource('/attribute', 'AttributeController', ['as' => 'admin']);

        Route::get('/admin-user-api-show', ['as' => 'admin.admin-user.show.api', 'uses' => 'AdminUserController@apiShow']);

        Route::post('product-image/upload', ['as' => 'admin.product.upload-image',
            'uses' => 'ProductController@uploadImage', ]);
        Route::post('product-image/delete', ['as' => 'admin.product.delete-image',
            'uses' => 'ProductController@deleteImage', ]);

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


        Route::get('order', [
                'as' => 'admin.order.index',
                'uses' => 'OrderController@index',
        ]);

        Route::post('get-property-element', [
            'as' => 'admin.property.element',
            'uses' => 'PropertyController@getElementHtml',
        ]);

        Route::post('edit-product-variation', [
            'as' => 'admin.variation.edit',
            'uses' => 'ProductController@editVariation',
        ]);

        Route::post('get-attribute-element', [
            'as' => 'admin.attribute.element',
            'uses' => 'AttributeController@getElementHtml',
        ]);

        Route::get('order/{id}', ['as' => 'admin.order.view', 'uses' => 'OrderController@view']);
        Route::get('order/{id}/send-email-invoice', ['as' => 'admin.order.send-email-invoice', 'uses' => 'OrderController@sendEmailInvoice']);

        Route::get('order/{id}/change-status', ['as' => 'admin.order.change-status', 'uses' => 'OrderController@changeStatus']);
        Route::put('order/{id}/update-status', ['as' => 'admin.order.update-status', 'uses' => 'OrderController@updateStatus']);
    });
