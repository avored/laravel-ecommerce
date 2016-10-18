<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Catalog Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 catalog modules.
  | It's a breeze. Simply tell mage2 catalog module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\Catalog\Controllers\Admin"], function () {

    Route::resource('/admin/product', 'ProductController', ['names' => [
            'index' => 'admin.product.index',
            'create' => 'admin.product.create',
            'store' => 'admin.product.store',
            'edit' => 'admin.product.edit',
            'update' => 'admin.product.update',
            'destroy' => 'admin.product.destroy',
    ]]);
    Route::resource('/admin/category', 'CategoryController', ['names' => [
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'store' => 'admin.category.store',
            'edit' => 'admin.category.edit',
            'update' => 'admin.category.update',
            'destroy' => 'admin.category.destroy',
    ]]);

    Route::get('/admin/product-search', 'ProductController@searchProduct');


    Route::post('/admin/product-image/upload', 'ProductController@uploadImage');
    Route::post('/admin/product-image/delete', 'ProductController@deleteImage');

    Route::get('/admin/configuration/catalog', ['as' => 'admin.configuration.catalog','uses' => 'ConfigurationController@getConfiguration']);
});


Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\Catalog\Controllers"], function () {

    Route::get('/category/{slug}', ['as' => 'category.view', 'uses' => 'CategoryViewController@view']);
    Route::get('/product/{slug}', ['as' => 'product.view', 'uses' => 'ProductViewController@view']);

});