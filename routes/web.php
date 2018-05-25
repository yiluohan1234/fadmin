<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
[
    'middleware' => 'web',
    'prefix'     => config('fadmin.base.route_prefix'),
],
function () {
    // if not otherwise configured, setup the auth routes
    if (config('fadmin.base.setup_auth_routes')) {
        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('fadmin.auth.login');
        Route::post('login', 'Auth\LoginController@login');
        Route::get('logout', 'Auth\LoginController@logout')->name('fadmin.auth.logout');
        Route::post('logout', 'Auth\LoginController@logout');
        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('fadmin.auth.register');
        Route::post('register', 'Auth\RegisterController@register');
        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('fadmin.auth.password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('fadmin.auth.password.reset.token');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('fadmin.auth.password.email');
    }
    if (config('fadmin.base.setup_dashboard_routes')) {
        Route::get('dashboard', 'Admin\PagesController@dashboard')->name('fadmin.dashboard');
        Route::get('/', 'Admin\PagesController@redirect')->name('fadmin');
    }
    // if not otherwise configured, setup the "my account" routes
    if (config('fadmin.base.setup_my_account_routes')) {
        Route::get('edit-account-info', 'Admin\AccountController@getAccountInfoForm')->name('fadmin.account.info');
        Route::post('edit-account-info', 'Admin\AccountController@postAccountInfoForm');
        Route::get('change-password', 'Admin\AccountController@getChangePasswordForm')->name('fadmin.account.password');
        Route::post('change-password', 'Admin\AccountController@postChangePasswordForm');
    }
});
/*
|--------------------------------------------------------------------------
| LogManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\LogManager package.
|
*/
Route::group([
            'middleware' => ['web', fadmin_middleware()],
            'prefix'     => config('base.route_prefix', 'admin'),
    ], function () {
        Route::get('log', 'Admin\LogController@index');
        Route::get('log/preview/{file_name}', 'Admin\LogController@preview');
        Route::get('log/download/{file_name}', 'Admin\LogController@download');
        Route::delete('log/delete/{file_name}', 'Admin\LogController@delete');
    });

