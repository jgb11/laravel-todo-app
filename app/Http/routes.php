<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('done/{id}', 'HomeController@getDone');
Route::get('delete/{id}', 'HomeController@getDelete');
Route::get('/settings', 'HomeController@getSettings');


Route::post('/create', 'HomeController@postCreate');
Route::post('/change-pass', 'HomeController@postChangePass');
