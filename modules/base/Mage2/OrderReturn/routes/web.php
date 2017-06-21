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
  | Mage2 Order Return Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 order  modules.
  | It's a breeze. Simply tell mage2 order module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'adminauth', 'permission', 'install'],
    'namespace' => "Mage2\OrderReturn\Controllers\Admin"], function () {

    Route::get('/admin/order-return/get-data', ['as' => 'admin.order-return.data-grid-table.get-data',
        'uses' => 'OrderReturnController@getDataGrid'
    ]);
    Route::resource('/admin/order-return', 'OrderReturnController', ['as' => 'admin']);
});


Route::group(['middleware' => ['web', 'install'], 'namespace' => "Mage2\OrderReturn\Controllers"], function () {

});


Route::group(['middleware' => ['web', 'frontauth', 'install'], 'namespace' => "Mage2\OrderReturn\Controllers"], function () {


    //Route::get('/my-account/order-return', ['as' => 'my-account.order-return.index', 'uses' => 'OrderReturnController@index']);



    Route::get('/my-account/order-return/{id}/create', ['as' => 'my-account.order-return.create', 'uses' => 'OrderReturnController@create']);
    Route::post('/my-account/order-return/{id}', ['as' => 'my-account.order-return.store', 'uses' => 'OrderReturnController@store']);

});
