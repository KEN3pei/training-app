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

Route::get('/edit', 'TrainingController@edit');
Route::post('/edit', 'TrainingController@img_update');
Route::post('/edit/upname', 'TrainingController@name_update');

Route::get('/profile', 'TrainingController@myprofile');
Route::post('/profile', 'TrainingController@myprofile');

Route::get('/groupe', 'GroupeController@index');
Route::post('/groupe', 'GroupeController@create');

Route::get('/groupe/add', 'GroupeController@add_groupe');
Route::post('/groupe/add', 'GroupeController@add_groupe');

Route::get('/groupe/serch', 'GroupeController@search');
Route::post('/groupe/serch', 'GroupeController@search');

Route::get('/delete', 'TrainingController@delete');
Route::post('/delete', 'TrainingController@delete');

Route::get('/calendar', 'CalendarController@index')->middleware('auth');
Route::get('/calendar/weeks', 'CalendarController@calendar')->middleware('auth');


Auth::routes();

Route::get('/logout', 'HomeController@index')->name('home');
Route::get('/home', 'TrainingController@add')->middleware('auth');
