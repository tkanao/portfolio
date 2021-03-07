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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    // CalendarControllerの設定
    Route::get('book/create', 'Admin\CalendarController@add');
    // AccountControllerの設定
    Route::get('book/edit', 'Admin\AccountController@edit');
    Route::Post('book/edit', 'Admin\AccountController@update');
    Route::get('book/index', 'Admin\AccountController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('/', 'admin/book/create');

Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');
