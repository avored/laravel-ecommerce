<?php
use Illuminate\Support\Facades\Route;

$baseAdminUrl = config('avored-framework.admin_url');


Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->namespace('AvoRed\Banner\Http\Controllers')
    ->name('admin.')
    ->group(function () {


        Route::get('banner',  'BannerController@index')
                        ->name('banner.index');

        Route::get('banner/create',  'BannerController@create')
            ->name('banner.create');
        Route::post('banner',  'BannerController@store')
            ->name('banner.store');


        Route::get('banner/{banner}/edit',  'BannerController@edit')
            ->name('banner.edit');
        Route::put('banner/{banner}',  'BannerController@update')
            ->name('banner.update');

        Route::delete('banner/{banner}',  'BannerController@destroy')
            ->name('banner.destroy');

        Route::get('banner/{banner}',  'BannerController@show')
            ->name('banner.show');

    });

