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

//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'LandingController@index');

Route::get('/questionary', 'QuestionaryController@index')->middleware('verified');

Route::get('/questionary/sports', 'SportsController@index')->middleware('verified');
Route::post('/questionary/sports', 'SportsController@store')->middleware('verified');
Route::get('/questionary/hangouts', 'HangoutsController@index')->middleware('verified');
Route::post('/questionary/hangouts', 'HangoutsController@store')->middleware('verified');
Route::get('/questionary/availability', 'AvailabilitiesController@index')->middleware('verified');
Route::post('/questionary/availability', 'AvailabilitiesController@store')->middleware('verified');

Route::get('/events', 'OccasionsController@index')->middleware('verified');
Route::get('/events/create', 'OccasionsController@create')->middleware('verified');
Route::post('/events', 'OccasionsController@store')->middleware('verified');


Route::get('/events/{occasion}', 'OccasionsController@show')->middleware('verified');
Route::get('/events/{occasion}/join_group', 'OccasionsController@join_group')->middleware('verified');
Route::get('/events/{occasion}/join_users', 'OccasionsController@join_users')->middleware('verified');
Route::get('/events/{occasion}/leave', 'OccasionsController@leave_event')->middleware('verified');
Route::post('/events/{occasion}/edit', 'OccasionsController@edit')->middleware('verified');
Route::get('/events/recreate/{occasion}', 'OccasionsController@recreate')->middleware('verified');
Route::delete('/events/{occasion}', 'OccasionsController@destroy')->middleware('verified');

Route::get('/groups', 'GroupsController@index')->middleware('verified');
Route::post('/groups', 'GroupsController@store')->middleware('verified');
Route::get('groups/{group}', 'GroupsController@show')->middleware('verified');
Route::post('groups/{group}', 'MessagesController@update')->middleware('verified');
Route::post('groups/{group}/edit', 'GroupsController@edit')->middleware('verified');
Route::get('/groups/{group}/leave', 'GroupsController@leave_group')->middleware('verified');


Route::post('messages/showLikes/{id}', 'MessagesController@showLikes');

Route::post('/autocomplete', 'AutocompleteController@fetch_names');

Route::get('/user/{user}', 'UsersController@index')->middleware('verified');
Route::post('/user/{user}', 'GroupsController@store')->middleware('verified');
Route::post('/users/addPersonToGroup', 'GroupsController@update')->middleware('verified');
Route::post('/users/addPersonToEvent', 'OccasionsController@update')->middleware('verified');
Route::post('/users/removePersonFromGroup', 'GroupsController@removePersonFromGroup')->middleware('verified');
Route::post('/users/removePersonFromEvent', 'OccasionsController@removePersonFromEvent')->middleware('verified');

Route::delete('/user/{group}', 'GroupsController@destroy')->middleware('verified');
Route::get('user/{user}/occasion-history', 'UsersController@history')->middleware('verified');

Route::get('/user/{user}/edit', 'UsersController@edit')->middleware('verified');
Route::post('/user/{user}/edit', 'UsersController@update')->middleware('verified');


Route::get('/wall', 'MessagesController@index')->middleware('verified');
Route::post('/wall', 'MessagesController@store')->middleware('verified');
//Route::post('/like', 'MessagesController@like');

Route::post('/notifications', 'NotificationsController@update');
Route::post('/notificationsAll', 'NotificationsController@checkAll');

Route::get('wall', 'MessagesController@index')->middleware('verified');

//Routes for followings
Route::post('/follow', 'FollowersController@follow');
Route::post('/unFollow', 'FollowersController@unFollow');

//routes for google registration
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

//Testing route for google api
Route::get('/googleapi', 'GoogleApiController@index');
