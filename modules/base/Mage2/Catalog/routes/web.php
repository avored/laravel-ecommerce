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
Route::group(['middleware' => ['web', 'adminauth','permission'], 'namespace' => "Mage2\Catalog\Controllers\Admin"], function () {
    Route::resource('/admin/product', 'ProductController', ['as' =>  'admin']);    
    Route::resource('/admin/category', 'CategoryController', ['as' =>  'admin']);

    Route::resource('/admin/review', 'ReviewController', ['as' => 'admin']);

    Route::post('/admin/product/attribute-panel', ['as' => 'admin.product-attribute.get-attribute','uses' => 'ProductController@getAttribute']);

    Route::resource('/admin/attribute', 'AttributeController', ['as' => 'admin']);
    Route::resource('/admin/option', 'OptionController', ['as' => 'admin']);

    Route::get('/admin/product-search', ['as' => 'admin.product.search','uses' => 'ProductController@searchProduct']);
    
    Route::post('/admin/product-image/upload', ['as' => 'admin.product.upload-image','uses' =>'ProductController@uploadImage']);
    Route::post('/admin/product-image/delete', ['as' => 'admin.product.delete-image','uses' =>'ProductController@deleteImage']);

    Route::get('/admin/configuration/catalog', ['as' => 'admin.configuration.catalog', 'uses' => 'ConfigurationController@getConfiguration']);
});


Route::group(['middleware' => ['web'], 'namespace' => "Mage2\Catalog\Controllers"], function () {

    Route::get('/category/{slug}', ['as' => 'category.view', 'uses' => 'CategoryViewController@view']);
    Route::get('/product/{slug}', ['as' => 'product.view', 'uses' => 'ProductViewController@view']);

    Route::resource('/review', 'ReviewController');


});
