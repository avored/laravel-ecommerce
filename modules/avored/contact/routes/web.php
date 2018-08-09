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

Route::middleware(['web'])
    ->namespace('AvoRed\Contact\Http\Controllers')
    ->group(function () {
        Route::get('contact', 'ContactController@index')->name('contact.index');

        Route::post('contact', 'ContactController@send')->name('contact.send');

    });