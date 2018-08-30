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


/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
| Home redirect to login
|
*/
Route::get('/', 'Admin\PagesController@redirect');

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
        Route::post('dashboard/country/data', 'Admin\PagesController@latest_data_of_country');
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
*/
Route::group([
    'middleware' => ['web', fadmin_middleware(), 'can:log_manager'],
    'prefix'     => config('base.route_prefix', 'admin'),
], function () {
    Route::get('log', 'Admin\LogController@index');
    Route::get('log/preview/{file_name}', 'Admin\LogController@preview');
    Route::get('log/download/{file_name}', 'Admin\LogController@download');
    Route::delete('log/delete/{file_name}', 'Admin\LogController@delete');
});

/*
|--------------------------------------------------------------------------
| BackupManager Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['web', 'admin', 'can:backup_manager'],
    'prefix'     => config('fadmin.base.route_prefix', 'admin'),
], function () {
    Route::get('backup', 'Admin\BackupController@index');
    Route::put('backup/create', 'Admin\BackupController@create');
    Route::get('backup/download/{file_name?}', 'Admin\BackupController@download');
    Route::delete('backup/delete/{file_name?}', 'Admin\BackupController@delete')->where('file_name', '(.*)');
});

/*
|--------------------------------------------------------------------------
| PermissionManager Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['web', fadmin_middleware(), 'can:permission_manager'],
    'prefix'     => config('fadmin.base.route_prefix', 'admin'),
], function () {
    CRUD::resource('permission', 'Admin\PermissionController');
    CRUD::resource('role', 'Admin\RoleController');
    CRUD::resource('user', 'Admin\UserController');
});

/*
|--------------------------------------------------------------------------
| Blogs Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['web', 'admin', 'can:wiki_manager'],
    'prefix' => config('fadmin.base.route_prefix', 'admin'),
], function () {
    CRUD::resource('article', 'Admin\ArticleController');
    CRUD::resource('category', 'Admin\CategoryController');
    CRUD::resource('tag', 'Admin\TagController');
    CRUD::resource('model', 'Admin\ModelController');
});
/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => config('fadmin.base.route_prefix', 'admin'),
    'middleware' => ['web', fadmin_middleware(), 'can:setting_manager'],
], function () {
    CRUD::resource('setting', 'Admin\SettingController');
    CRUD::resource('link', 'Admin\LinksController');
    CRUD::resource('timeline', 'Admin\TimelineController');
    Route::get('schedule', 'Admin\ScheduleController@index')->name('fadmin.schedule.index');
    Route::post('schedule/run', 'Admin\ScheduleController@run');
});
/*
|--------------------------------------------------------------------------
| data monitor Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['web', 'admin'],
    'prefix' => config('fadmin.base.route_prefix', 'admin'),
], function () {
    Route::get('monitor/table', 'Admin\MonitorController@table')->name('fadmin.monitor.table');
    Route::get('monitor/table/data', 'Admin\MonitorController@tabledata');
    Route::get('monitor/picture', 'Admin\MonitorController@picture')->name('fadmin.monitor.picture');
    Route::post('monitor/picture/odata', 'Admin\MonitorController@odata');
    Route::post('monitor/picture/filesystem', 'Admin\MonitorController@filesystem');
    Route::get('monitor/test', 'Admin\MonitorController@test')->name('test');
    Route::get('monitor/log-show', 'Admin\MonitorController@logShow')->name('fadmin.monitor.logShow');
    Route::get('monitor/log/show', 'Admin\MonitorController@logdata');
    // Route::get('monitor/map', 'Admin\MonitorController@map')->name('map');
    // Route::post('monitor/map/mdata', 'Admin\MonitorController@mdata');
    // Route::post('monitor/map/mddata/', 'Admin\MonitorController@mddata');
    Route::get('monitor/run', 'Admin\MonitorController@run');
});
/*
|--------------------------------------------------------------------------
| fast analysis Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['web', 'admin'],
    'prefix' => config('fadmin.base.route_prefix', 'admin'),
], function () {
    // Route::get('analysis/users', 'Admin\AnalysisController@users')->name('fadmin.analysis.users');
    // Route::post('analysis/users/udata', 'Admin\AnalysisController@udata');
    // Route::get('analysis/fees', 'Admin\AnalysisController@fees')->name('fadmin.analysis.fees');
    // Route::post('analysis/fees/fdata', 'Admin\AnalysisController@fdata');
    // Route::get('analysis/dou', 'Admin\AnalysisController@dou')->name('fadmin.analysis.dou');
    // Route::post('analysis/dou/ddata', 'Admin\AnalysisController@ddata');
    Route::get('analysis/statics', 'Admin\AnalysisController@statics')->name('fadmin.analysis.statics');
    Route::post('analysis/statics/sdata', 'Admin\AnalysisController@sdata');
});

/*
|--------------------------------------------------------------------------
| wodas manager Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['web', 'admin'],
    'prefix' => config('fadmin.base.route_prefix', 'admin'),
], function () {
    CRUD::resource('wodas', 'Admin\WodasController');
});


