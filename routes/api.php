<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('users', 'UserController',['only'=>['index','store','show']]);
Route::resource('events', 'EventController',['only'=>['index','store','show']]);
Route::resource('users.events','UserEventController',['only'=>['index']]);
Route::resource('events.users','EventUserController',['only'=>['index']]);

Route::post('users/{user}/events/{event}/book','UserController@book_event');