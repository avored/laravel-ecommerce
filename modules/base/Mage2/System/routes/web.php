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
  | Mage2 Theme  Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 System  modules.
  | It's a breeze. Simply tell mage2 theme  module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web', 'install'], 'namespace' => "Mage2\System\Controllers"], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});


Route::group(['middleware' => ['web', 'adminauth', 'permission', 'install'], 'namespace' => "Mage2\System\Controllers\Admin"], function () {

    Route::get('/admin/configuration/general', ['as' => 'admin.configuration.general', 'uses' => 'ConfigurationController@getGeneralConfiguration']);

    Route::get('/admin/configuration', ['as' => 'admin.configuration', 'uses' => 'ConfigurationController@index']);
    Route::post('/admin/configuration', ['as' => 'admin.configuration.store', 'uses' => 'ConfigurationController@store']);


    Route::get('/admin', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

    Route::get('/admin/module', ['as' => 'admin.module.index', 'uses' => 'ModuleController@index']);

    Route::get('/admin/module/create', ['as' => 'admin.module.create', 'uses' => 'ModuleController@create']);
    Route::post('/admin/module', ['as' => 'admin.module.store', 'uses' => 'ModuleController@store']);

    Route::post('/admin/module/install/{identifier}', ['as' => 'admin.module.install', 'uses' => 'ModuleController@install']);
    Route::post('/admin/module/uninstall/{identifier}', ['as' => 'admin.module.uninstall', 'uses' => 'ModuleController@uninstall']);

    Route::get('/admin/themes', ['as' => 'admin.theme.index', 'uses' => 'ThemeController@index']);

    Route::get('/admin/themes/create', ['as' => 'admin.theme.create', 'uses' => 'ThemeController@create']);
    Route::post('/admin/themes', ['as' => 'admin.theme.store', 'uses' => 'ThemeController@store']);

    Route::post('/admin/themes/{name}', ['as' => 'admin.theme.activate', 'uses' => 'ThemeController@activate']);

    Route::delete('/admin/themes/{name}', ['as' => 'admin.theme.destroy', 'uses' => 'ThemeController@destroy']);
});




