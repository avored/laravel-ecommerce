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
use Illuminate\Support\Facades\Route;

$baseAdminUrl = config('avored-ecommerce.admin_url');

Route::middleware(['web'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->namespace('AvoRed\Ecommerce\Http\Controllers')
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
    ->name('admin.')
    ->namespace('AvoRed\Ecommerce\Http\Controllers')
    ->group(function () {
        Route::get('', 'DashboardController@index')->name('dashboard');

        Route::resource('admin-user', 'AdminUserController')->except('show');
        Route::resource('attribute', 'AttributeController');
        Route::resource('category', 'CategoryController');
        Route::resource('page', 'PageController');
        Route::resource('product', 'ProductController');
        Route::resource('property', 'PropertyController');
        Route::resource('role', 'RoleController');

        Route::get('menu', 'MenuController@index')->name('menu.index');
        Route::post('menu', 'MenuController@store')->name('menu.store');

        Route::post('product-attribute-panel', 'AttributeController@getAttribute')
                                ->name('product-attribute.get-attribute');
        Route::post('product-image/upload', 'ProductController@uploadImage')->name('product.upload-image');
        Route::post('product-image/delete', 'ProductController@deleteImage')->name('product.delete-image');

        Route::get('product-downloadable-demo/{token}', 'ProductController@downloadDemoToken')
                                ->name('product.download.demo.media');
        Route::get('product-downloadable-main/{token}', 'ProductController@downloadMainToken')
                                ->name('product.download.main.media');

        Route::get('admin-user/view', 'AdminUserController@show')->name('admin-user.show');
        Route::get('admin-user-api-show', 'AdminUserController@apiShow')->name('admin-user.show.api');

        Route::get('configuration', 'ConfigurationController@index')->name('configuration');
        Route::post('configuration', 'ConfigurationController@store')->name('configuration.store');

        Route::get('themes', 'ThemeController@index')->name('theme.index');
        Route::get('themes/create', 'ThemeController@create')->name('theme.create');
        Route::post('themes', 'ThemeController@store')->name('theme.store');
        Route::post('active-themes/{name}', 'ThemeController@activated')->name('theme.activated');
        Route::post('deactive-themes/{name}', 'ThemeController@deactivated')->name('theme.deactivated');
        Route::delete('themes/{name}', 'ThemeController@destroy')->name('theme.destroy');

        //Route::resource('order-status', 'OrderStatusController');


        Route::get('order', 'OrderController@index')->name('order.index');

        Route::post('get-property-element', 'PropertyController@getElementHtml')->name('property.element');
        Route::post('edit-product-variation', 'ProductController@editVariation')->name('variation.edit');
        Route::post('get-attribute-element', 'AttributeController@getElementHtml')->name('attribute.element');

        Route::get('order/{order}', 'OrderController@view')->name('order.view');
        Route::get('order/{order}/send-email-invoice', 'OrderController@sendEmailInvoice')->name('order.send-email-invoice');
        Route::get('order/{order}/change-status', 'OrderController@editStatus')->name('order.change-status');
        Route::put('order/{order}/update-status', 'OrderController@updateStatus')->name('order.update-status');
    });
