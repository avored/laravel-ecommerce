<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')
                ->name('home');

Route::get('/category/{slug}', 'CategoryViewController@view')
                ->name('category.view');

Route::get('/product/{slug}','ProductViewController@view')
                ->name('product.view');