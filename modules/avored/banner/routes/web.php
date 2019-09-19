<?php
$baseAdminUrl = config('avored.admin_url');

Route::middleware(['web', 'admin.auth'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->group(function () {
        Route::get('banner', AvoRed\Banner\Http\Controllers\TableController::class)
            ->name('banner.table');
        Route::get(
            'banner-edit/{banner?}',
            AvoRed\Banner\Http\Controllers\EditController::class
        )->name('banner.edit');
        Route::post(
            'banner-save/{banner?}',
            AvoRed\Banner\Http\Controllers\SaveController::class
        )->name('banner.save');
        Route::delete('banner/{banner}', AvoRed\Banner\Http\Controllers\DestroyController::class)
            ->name('banner.destroy');
        Route::post('banner-upload', AvoRed\Banner\Http\Controllers\UploadController::class)
            ->name('banner.upload');
    });
