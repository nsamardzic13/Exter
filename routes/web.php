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

//Route if we dont use verify email
//Auth::routes();
//Rouse if we do
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/questionary', 'QuestionaryController@index');

Route::get('/questionary/sports', 'SportsController@index');
Route::post('/questionary/sports', 'SportsController@store');
Route::get('/questionary/hangouts', 'HangoutsController@index');
Route::post('/questionary/hangouts', 'HangoutsController@store');
Route::get('/questionary/availability', 'AvailabilitiesController@index');
Route::post('/questionary/availability', 'AvailabilitiesController@store');

Route::get('/events', 'OccasionsController@index');
Route::get('/events/create', 'OccasionsController@create');
Route::post('/events', 'OccasionsController@store');

Route::get('/events/{occasion}/wall', 'OccasionsController@wall');

Route::get('/groups', 'GroupsController@index');
Route::post('/groups', 'GroupsController@store');
Route::get('groups/{group}', 'GroupsController@show');
//Route::patch('groups/{group}', 'GroupsController@update');
Route::patch('groups/{group}', 'MessagesController@update');
Route::post('/autocomplete', 'AutocompleteController@fetch_names');

Route::get('/user/{user}', 'UsersController@index');
Route::post('/user/{user}', 'GroupsController@store');
Route::post('/users/addPersonToGroup', 'GroupsController@update');
Route::delete('/user/{group}', 'GroupsController@destroy');
Route::get('user/{user}/occasion-history', 'UsersController@history');

Route::get('/user/{user}/edit', 'UsersController@edit');
Route::post('/user/{user}/edit', 'UsersController@update');

Route::get('/wall', 'MessagesController@index');
Route::post('/wall', 'MessagesController@store');
//Route::post('/like', 'MessagesController@like');

//routes for google registration
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
