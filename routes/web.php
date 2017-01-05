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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ImageController@index');



Route::get('images','ImageController@index');
Route::post('images/add','ImageController@add');
Route::get('images/{image}','ImageController@get');

Route::post('/like/{image}','UserController@like');
Route::get('/getLikes/{image}','ImageController@getLikes');

Route::get('/users','UserController@index');

Route::post('/follow/{user}','UserController@follow_user');