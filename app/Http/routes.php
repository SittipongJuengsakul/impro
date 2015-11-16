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
//Route::get('user/test','SlideController@testSocket');

Route::get('fire', function () {
    // this fires the event
    event(new App\Events\UpdateTotalTbl());
    return "event fired";
});

Route::get('test', function () {
    return view('test');
});

Route::get('user/report','HomeController@showdata');
Route::post('user/submit','HomeController@submit');
Route::post('user/excel_php','HomeController@excel_php');

Route::get('user/form_estimate','HomeController@form_estimate');
Route::post('user/set_estimate','HomeController@set_estimate');
Route::post('user/save_estimate','HomeController@save_estimate');
Route::post('user/tool_estimate','HomeController@tool_estimate');
Route::post('user/save_toolestimate','HomeController@save_toolestimate');
Route::get('user/form_toolestimate','HomeController@form_toolestimate');
