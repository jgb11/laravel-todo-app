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
  if(session()->has('lang')){
    App::setLocale(session()->get('lang'));
  }
  return view('welcome');
});

Route::auth();

Route::get('home', 'HomeController@index');
Route::get('done/{id}', 'HomeController@getDone')->where('id', '[0-9]+');
Route::get('delete/{id}', 'HomeController@getDelete')->where('id', '[0-9]+');
Route::get('settings', 'HomeController@getSettings');
Route::get('language/{lang}', function($lang){
  session()->put('lang', $lang);
  return back();
})
->where('lang', '[a-z]{2}');


Route::post('create', 'HomeController@postCreate');
Route::post('change-pass', 'HomeController@postChangePass');
Route::post('share', 'HomeController@postShare');
