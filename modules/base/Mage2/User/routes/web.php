<?php

/*
  |--------------------------------------------------------------------------
  | Mage2 User Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 user modules.
  | It's a breeze. Simply tell mage2 user module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\User\Controllers\Admin"], function () {

    Route::get('/admin/login', ['as' => 'admin.login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('/admin/login', ['as' => 'admin.login.post', 'uses' => 'LoginController@login']);

    Route::get('/admin/logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

    Route::get('/admin/password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('/admin/password/reset', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@reset']);

    Route::get('/admin/password/reset', ['as' => 'password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);

});

Route::group(['middleware' => ['web', 'adminauth', 'website'], 'namespace' => "Mage2\User\Controllers\Admin"], function () {
    Route::resource('/admin/user', 'UserController', ['names' => [
            'index'   => 'admin.user.index',
            'create'  => 'admin.user.create',
            'store'   => 'admin.user.store',
            'edit'    => 'admin.user.edit',
            'update'  => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]]);


});
Route::group(['middleware' => ['web', 'frontauth', 'website'], 'namespace' => "Mage2\User\Controllers"], function () {
    Route::get('/my-account', ['as' => 'my-account.home', 'uses' => 'MyAccountController@home']);
    Route::get('/my-account/edit', ['as' => 'my-account.edit', 'uses' => 'MyAccountController@edit']);
    Route::post('/my-account/edit', ['as' => 'my-account.store', 'uses' => 'MyAccountController@store']);
});



Route::group(['middleware' => ['web', 'website'], 'namespace' => "Mage2\User\Controllers"], function () {
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'LoginController@login']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    Route::get('/password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('/password/reset', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@reset']);

    Route::get('/password/reset', ['as' => 'password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::post('/password/email', ['as' => 'password.email.post', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);

    Route::get('/register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('/register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);
});
