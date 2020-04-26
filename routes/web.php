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

Route::get('/hoge', 'hoge\HogeController@getAction');
Route::post('/add', 'hoge\HogeController@add');
Route::post('/delete/{id}', 'hoge\HogeController@delete');


Route::get('/greet', 'GreetController@getAction');