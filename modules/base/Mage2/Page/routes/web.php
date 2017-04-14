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

Route::group(['middleware' => ['web', 'adminauth', 'permission'], 'namespace' => "Mage2\Page\Controllers\Admin"], function () {

    Route::get('/admin/page/get-datatable-data', ['as' => 'admin.page.data-grid-table.get-data',
        'uses' => 'PageController@getDataGrid'
    ]);
    Route::resource('/admin/page', 'PageController', ['as' => 'admin']);
});


Route::group(['middleware' => ['frontauth', 'web'], 'namespace' => "Mage2\Page\Controllers"], function () {
});
