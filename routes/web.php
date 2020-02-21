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

Route::get('/', 'RegisterController@create')->name('index');
Route::get('create', 'RegisterController@create')->name('create');
Route::post('/', 'RegisterController@store')->name('store');
