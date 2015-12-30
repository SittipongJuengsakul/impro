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

Route::get('/','SlideController@slideshowdata');
Route::get('home','SlideController@slideshowdata');
Route::get('guest/home','SlideController@slideshowdata');
Route::get('user/home','HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);
Route::get('user/slideshow','SlideController@slideshowdata');
Route::get('user/slideshow/building_all_data','SlideController@building_all_data');
Route::get('user/slideshow/building_data/{building}','SlideController@building_data');
Route::get('user/slideshow/chillerplant_show_all','SlideController@chillerplant_show_all');
Route::get('user/slideshow/showkwh_all','SlideController@showkwh_all');

Route::get('user/report','HomeController@showdata');
Route::post('user/submit','HomeController@submit');
Route::post('user/excel_php','HomeController@excel_php');

Route::get('user/form_estimate','HomeController@form_estimate');
Route::post('user/set_estimate','HomeController@set_estimate');
Route::post('user/save_estimate','HomeController@save_estimate');
Route::post('user/tool_estimate','HomeController@tool_estimate');
Route::post('user/save_toolestimate','HomeController@save_toolestimate');
Route::get('user/form_toolestimate','HomeController@form_toolestimate');
