<?php




Route::prefix('api')
    ->middleware(['api'])
    ->namespace("Mage2\Framework\Http\Controllers\Api")
    ->group(function() {

        Route::get('v1/categories', 'CategoryController@index');

        Route::post('v1/category', 'CategoryController@store');

        Route::get('v1/category/{id}', 'CategoryController@show');

        Route::put('v1/category/{id}', 'CategoryController@update');

        Route::delete('v1/category/{id}', 'CategoryController@destroy');

    });



