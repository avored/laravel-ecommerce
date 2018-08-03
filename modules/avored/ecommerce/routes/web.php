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


Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->namespace('AvoRed\Ecommerce\Http\Controllers')
    ->group(function () {
        Route::get('', 'DashboardController@index')->name('dashboard');

        Route::resource('admin-user', 'AdminUserController')->except('show');
        
        Route::resource('page', 'PageController');
        
        Route::resource('role', 'RoleController');
        Route::resource('site-currency', 'SiteCurrencyController');

        Route::get('menu', 'MenuController@index')->name('menu.index');
        Route::post('menu', 'MenuController@store')->name('menu.store');


        Route::get('admin-user/view', 'AdminUserController@show')->name('admin-user.show');
        Route::get('admin-user-api-show', 'AdminUserController@apiShow')->name('admin-user.show.api');

        Route::get('configuration', 'ConfigurationController@index')->name('configuration');
        Route::post('configuration', 'ConfigurationController@store')->name('configuration.store');

        /** --------  Modules ROUTES  -------- **/
        Route::get('module', 'ModuleController@index')->name('module.index');
        Route::get('module/create', 'ModuleController@create')->name('module.create');
        Route::post('module', 'ModuleController@store')->name('module.store');

        Route::get('themes', 'ThemeController@index')->name('theme.index');
        Route::get('themes/create', 'ThemeController@create')->name('theme.create');
        Route::post('themes', 'ThemeController@store')->name('theme.store');
        Route::post('active-themes/{name}', 'ThemeController@activated')->name('theme.activated');
        Route::post('deactive-themes/{name}', 'ThemeController@deactivated')->name('theme.deactivated');
        Route::delete('themes/{name}', 'ThemeController@destroy')->name('theme.destroy');

        //Route::resource('order-status', 'OrderStatusController');

        Route::get('order', 'OrderController@index')->name('order.index');

        
        Route::get('order/{order}', 'OrderController@view')->name('order.view');
        Route::get('order/{order}/send-email-invoice', 'OrderController@sendEmailInvoice')->name('order.send-email-invoice');
        Route::get('order/{order}/change-status', 'OrderController@editStatus')->name('order.change-status');
        Route::put('order/{order}/update-status', 'OrderController@updateStatus')->name('order.update-status');
    });
