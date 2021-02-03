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

Route::group(['prefix' => 'admin'], function() {
    Route::get('book/create', 'Admin\BookController@add');
    Route::get('book/edit', 'Admin\BookController@edit');
    Route::Post('book/edit', 'Admin\BookController@update');
    Route::get('book/index', 'Admin\BookController@index');
});
