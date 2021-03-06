<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/register', 'Auth\RegisterController@register')->middleware('can-register');
Route::post('auth/sendPasswordResetLink', 'Auth\ResetPasswordController@sendEmail');
Route::post('auth/resetPassword', 'Auth\ChangePasswordController@process');
Route::post('auth/googleLogin', 'Auth\Social\GoogleController@try')->middleware('google-login');
Route::post('auth/facebookLogin', 'Auth\Social\FacebookController@try')->middleware('facebook-login');
Route::get('admin/configuration/{id}', 'Admin\ConfigurationController@show');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user', 'Auth\UserController@user');
    Route::get('/roles', 'Auth\UserController@roles');

        Route::group(['middleware' => ['role:admin|super-admin']], function () {

            Route::get('admin/user', 'Admin\UserController@index');
            Route::get('admin/user/{user}', 'Admin\UserController@show');
            Route::get('admin/role', 'Admin\RoleController@index');

        });

    Route::group(['middleware' => ['role:super-admin']], function () {

        Route::get('admin/configuration', 'Admin\ConfigurationController@index');
        Route::put('admin/configuration/{id}', 'Admin\ConfigurationController@update');

        Route::post('admin/user', 'Admin\UserController@store');
        Route::put('admin/user/{user}', 'Admin\UserController@update');
        Route::delete('admin/user/{user}', 'Admin\UserController@destroy');

        Route::put('admin/role/{role}/{user}', 'Admin\RoleController@update');
    });

});
