<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Order Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 order  modules.
  | It's a breeze. Simply tell mage2 order module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\Order\Controllers\Admin"], function () {
    Route::resource('/admin/order-status', 'OrderStatusController', ['names' => [
            'index'   => 'admin.order-status.index',
            'create'  => 'admin.order-status.create',
            'store'   => 'admin.order-status.store',
            'edit'    => 'admin.order-status.edit',
            'update'  => 'admin.order-status.update',
            'destroy' => 'admin.order-status.destroy',
    ]]);

    Route::get('/admin/order', ['as' => 'admin.order.index', 'uses' => 'OrderController@index']);
    Route::get('/admin/order/{id}', ['as' => 'admin.order.view', 'uses' => 'OrderController@view']);
    Route::get('/admin/order/{id}/send-email-invoice', ['as' => 'admin.order.send-email-invoice', 'uses' => 'OrderController@sendEmailInvoice']);

    Route::get('/admin/order/{id}/change-status', ['as' => 'admin.order.change-status', 'uses' => 'OrderController@changeStatus']);
    Route::put('/admin/order/{id}/update-status', ['as' => 'admin.order.update-status', 'uses' => 'OrderController@updateStatus']);
});


Route::group(['middleware' => ['web', 'frontauth', 'website'], 'namespace' => "Mage2\Order\Controllers"], function () {
    Route::get('/order', ['as' => 'order.index', 'uses' => 'OrderController@index']);
    Route::get('/order/success/{id}', ['as' => 'order.success', 'uses' => 'OrderController@success']);

    Route::get('/my-account/order/list', ['as' => 'my-account.order.list', 'uses' => 'OrderController@myAccountOrderList']);
    Route::get('/my-account/order/{id}/view', ['as' => 'my-account.order.view', 'uses' => 'OrderController@myAccountOrderView']);
});
