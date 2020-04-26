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
    return view('welcome2');
});

Route::get('/hoge', 'hoge\HogeController@getAction');
Route::post('/add', 'hoge\HogeController@add');
Route::post('/delete/{id}', 'hoge\HogeController@delete');


Route::get('/greet', 'GreetController@getAction');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/board', 'HomeController@index')->name('board');

Route::post('/register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');

Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');