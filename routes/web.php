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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Admin\TopController@login')->middleware('auth');
//バイト側
Route::group(['prefix' => 'parttime','middleware' => 'auth'], function () {
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
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
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
    Route::post('schedule/editedit-parttime', 'Admin\ScheduleController@update_parttime');
    Route::get('schedule/deleteedit-parttime', 'Admin\ScheduleController@delete_parttime');
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
});
