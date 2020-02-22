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
Route::get('/', 'TrainingController@tweet')->middleware('auth');
Route::post('/', 'TrainingController@tweet');
Route::get('/delete', 'TrainingController@delete')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'TrainingController@add')->middleware('auth');


