<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 Page Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 page modules.
  | Simply tell mage2 page module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\Page\Controllers\Admin"], function () {
    Route::resource('/admin/page', 'PageController', ['names' => [
        'index'     => 'admin.page.index',
        'create'    => 'admin.page.create',
        'store'     => 'admin.page.store',
        'edit'      => 'admin.page.edit',
        'update'    => 'admin.page.update',
        'destroy'   => 'admin.page.destroy',
    ]]);
});



Route::group(['middleware' => ['frontauth', 'web', 'website'],  'namespace' => "Mage2\Page\Controllers"], function () {
});
