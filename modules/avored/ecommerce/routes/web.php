<?php

/*
  |--------------------------------------------------------------------------
  | AvoRed E commerce Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an avored user modules.
  | It's a breeze. Simply tell avored user module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
use Illuminate\Support\Facades\Route;

$baseAdminUrl = config('avored-ecommerce.admin_url');


Route::middleware(['web', 'admin.auth', 'permission'])
    ->prefix($baseAdminUrl)
    ->name('admin.')
    ->namespace('AvoRed\Ecommerce\Http\Controllers')
    ->group(function () {
        
        
        
        /** --------  Modules ROUTES  -------- **/
        //Route::resource('order-status', 'OrderStatusController');

        
    });
