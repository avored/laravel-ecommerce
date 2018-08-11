<?php

Route::middleware(['web'])
    ->namespace('AvoRed\Review\Http\Controllers')
    ->group(function () {
        Route::post('review', 'ReviewController@store')->name('review.store');
    });


$baseAdminUrl = config('avored-framework.admin_url');

Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\Review\Http\Controllers\Admin')
    ->name('admin.')
    ->group(function () {
        Route::get('review',  'ReviewController@index')
            ->name('review.index');

        Route::get('review/{productReview}',  'ReviewController@approve')
            ->name('review.approve');

    });