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
  | Mage2 Order Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 order  modules.
  | It's a breeze. Simply tell mage2 order module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'adminauth', 'permission', 'install'],
    'namespace' => "Mage2\Order\Controllers\Admin"], function () {

    Route::get('/admin/order/get-datatable-data', ['as' => 'admin.order.data-grid-table.get-data',
        'uses' => 'OrderController@getDataGrid'
    ]);


    Route::get('/admin/order', ['as' => 'admin.order.index', 'uses' => 'OrderController@index']);
    Route::get('/admin/order/{id}', ['as' => 'admin.order.view', 'uses' => 'OrderController@view']);
    Route::get('/admin/order/{id}/send-email-invoice', ['as' => 'admin.order.send-email-invoice', 'uses' => 'OrderController@sendEmailInvoice']);

    Route::get('/admin/order/{id}/change-status', ['as' => 'admin.order.change-status', 'uses' => 'OrderController@changeStatus']);
    Route::put('/admin/order/{id}/update-status', ['as' => 'admin.order.update-status', 'uses' => 'OrderController@updateStatus']);
});


Route::group(['middleware' => ['web', 'install'], 'namespace' => "Mage2\Order\Controllers"], function () {
    Route::post('/order', ['as' => 'order.place', 'uses' => 'OrderController@place']);
});


Route::group(['middleware' => ['web', 'frontauth', 'install'], 'namespace' => "Mage2\Order\Controllers"], function () {
    Route::get('/order', ['as' => 'order.index', 'uses' => 'OrderController@index']);
    Route::get('/order/success/{id}', ['as' => 'order.success', 'uses' => 'OrderController@success']);

    Route::get('/my-account/order/list', ['as' => 'my-account.order.list', 'uses' => 'OrderController@myAccountOrderList']);
    Route::get('/my-account/order/{id}/view', ['as' => 'my-account.order.view', 'uses' => 'OrderController@myAccountOrderView']);
});
