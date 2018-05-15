<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')
    ->middleware(['api'])
    ->namespace("AvoRed\Framework\Http\Controllers\Api")
    ->group(function () {
        Route::get('v1/category', 'CategoryController@index');

        Route::post('v1/category', 'CategoryController@store');

        Route::get('v1/category/{id}', 'CategoryController@show');

        Route::put('v1/category/{id}', 'CategoryController@update');

        Route::delete('v1/category/{id}', 'CategoryController@destroy');
    });
