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
Route::get('foo','FooController@foo');

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('about','HomeController@about');
// Route::get('articles','ArticlesController@index');
// Route::get('articles/create','ArticlesController@create');
// Route::get('articles/{id}','ArticlesController@show');
// Route::post('articles','ArticlesController@store');
Route::resource('articles','ArticlesController');//CRUD

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('manager',['middleware'=>'manager',function()
{
	return 'This page is for Managers Only!!!';
}]);
