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

// Route::middleware('verified')->group(function() {
//     Route::get('/home', 'HomeController@index')->name('home');

// });

Route::get('/home', 'HomeController@getAction')->name('home');

// Route::prefix('api')->group(function() {
    Route::get('/api/message/get','HomeController@getListAction');
    Route::post('/api/message/store','HomeController@store');
    Route::post('/api/message/delete/{message_id}','HomeController@destroy');
    Route::post('/api/message/edit','HomeController@edit');


// });

// Route::get('/home2', 'HomeController@index')->name('home2');


Route::get('/board', 'HomeController@index')->name('board');

Route::post('/register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

Route::post('/register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');

Route::post('/register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

Route::get('/register/verify/{token}', 'Auth\RegisterController@showForm');




Route::get('/send', 'TestMailController@sendMail')->name('send');

