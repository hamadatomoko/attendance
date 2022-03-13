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
Route::group([ 'middleware' => 'auth'], function() {
    Route::get('/' ,'TopController@index');  

});
Route::group(['prefix' => 'parttime','middleware' => 'auth'], function() {
    Route::get('schedule/create', 'parttime\ScheduleController@add');

     Route::post('schedule/create', 'parttime\ScheduleController@create');

     Route::get('schedule/edit', 'parttime\ScheduleController@edit');
      Route::post('schedule/edit', 'parttime\ScheduleController@update');
      Route::get('schedule/delete', 'parttime\ScheduleController@delete');
});