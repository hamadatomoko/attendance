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


// Auth::routes(["reset"=> false, "verify" => false
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
 Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
 Route::group(['middleware' => ['auth', 'can:manage_member']], function () {
     //ユーザー登録
     Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
     Route::post('register', 'Auth\RegisterController@register');
 });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Admin\TopController@login')->middleware('auth');
//バイト側
Route::group(['prefix' => 'parttime','middleware' => ['auth', 'can:parttime_member']], function () {
    Route::get('/', 'parttime\TopController@index');
    Route::get('schedule/create/{date}', 'parttime\ScheduleController@add');
    Route::post('schedule/create', 'parttime\ScheduleController@create');
    Route::get('schedule/edit', 'parttime\ScheduleController@edit');
    Route::post('schedule/edit', 'parttime\ScheduleController@update');
    Route::get('schedule/delete', 'parttime\ScheduleController@delete');
    Route::get('attendance', 'parttime\AttendanceController@index');
    Route::get('attendance/create', 'parttime\AttendanceController@add');
    Route::post('attendance/create', 'parttime\AttendanceController@create');
    Route::get('attendance/edit', 'parttime\AttendanceController@edit');
    Route::post('attendance/edit', 'parttime\AttendanceController@update');
    Route::get('attendance/delete', 'parttime\AttendanceController@delete');
});
Route::group(['prefix' => 'admin','middleware' => ['auth', 'can:manage_member']], function () {
    // 管理側トップ
    Route::get('/', 'Admin\TopController@index');
    // イベント告知
    Route::get('schedule', 'Admin\ScheduleController@index');
    Route::get('schedule/create', 'Admin\ScheduleController@add');
    Route::post('schedule/create', 'Admin\ScheduleController@create');
    Route::get('schedule/edit', 'Admin\ScheduleController@edit');
    Route::post('schedule/edit', 'Admin\ScheduleController@update');
    Route::get('schedule/delete', 'Admin\ScheduleController@delete');
    Route::get('schedule/edit-parttime', 'Admin\ScheduleController@edit_parttime');
    Route::post('schedule/edit-parttime', 'Admin\ScheduleController@update_parttime');
    Route::get('schedule/delete-parttime', 'Admin\ScheduleController@delete_parttime');
    // バイト勤怠一覧
    Route::get('attendance', 'Admin\AttendanceController@index');
    Route::get('attendance/create', 'Admin\AttendanceController@add');
    Route::post('attendance/create', 'Admin\AttendanceController@create');
    Route::get('attendance/edit', 'Admin\AttendanceController@edit');
    Route::post('attendance/edit', 'Admin\AttendanceController@update');
    Route::get('attendance/delete', 'Admin\AttendanceController@delete');
    // バイトユーザ管理
    Route::get('user', 'Admin\UserController@index');
    Route::get('user/create', 'Admin\UserController@add');
    Route::post('user/create', 'Admin\UserController@create');
    Route::get('user/edit', 'Admin\UserController@edit');
    Route::post('user/edit', 'Admin\UserController@update');
    Route::get('user/delate', 'Admin\UserController@delete');
    // バイト時給
    Route::get('wage', 'Admin\WageController@index');
    Route::get('wage/create', 'Admin\WageController@add');
    Route::post('wage/create', 'Admin\WageController@create');
    Route::get('wage/delete', 'Admin\WageController@delete');
});
