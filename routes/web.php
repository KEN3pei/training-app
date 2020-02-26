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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'TrainingController@add')->middleware('auth');
Route::post('/', 'TrainingController@tweet');//更新したらaddにリダイレクトすればいい？
Route::get('/delete', 'TrainingController@delete')->middleware('auth');
Route::get('/calendar', 'CalendarController@index')->middleware('auth');
Route::get('/calendar/weeks', 'CalendarController@calendar')->middleware('auth');


Auth::routes();

Route::get('/logout', 'HomeController@index')->name('home');
Route::get('/home', 'TrainingController@add')->middleware('auth');


