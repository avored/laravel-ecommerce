<?php

/*
  |--------------------------------------------------------------------------
  | Review Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'website','adminauth'], 'namespace' => "Mage2\Review\Controllers\Admin"], function () {
    Route::resource('/admin/review', 'ReviewController', ['names' => [
        'index'     => 'admin.review.index',
        'create'    => 'admin.review.create',
        'store'     => 'admin.review.store',
        'edit'      => 'admin.review.edit',
        'update'    => 'admin.review.update',
        'destroy'   => 'admin.review.destroy',
    ]]);

});

Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\Review\Controllers"], function () {
    Route::resource('/review', 'ReviewController', ['names' => [
        'index'     => 'review.index',
        'create'    => 'review.create',
        'store'     => 'review.store',
        'edit'      => 'review.edit',
        'update'    => 'review.update',
        'destroy'   => 'review.destroy',
    ]]);

});