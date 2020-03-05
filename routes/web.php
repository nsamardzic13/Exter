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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/questionary', 'QuestionaryController@index');

Route::get('/questionary/sports', 'SportsController@index');
Route::post('/questionary/sports', 'SportsController@store');
Route::get('/questionary/hangouts', 'HangoutsController@index');
Route::post('/questionary/hangouts', 'HangoutsController@store');
Route::get('/questionary/availability', 'AvailabilitiesController@index');
Route::post('/questionary/availability', 'AvailabilitiesController@store');
