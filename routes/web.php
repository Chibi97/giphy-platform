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

Auth::routes();

Route::get('/','PostController@index');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/{user}', 'PostController@user')->name('user-posts');
Route::delete('/post/{id}', 'PostController@delete')->name('delete-post');
Route::get('/localization/{locale}', 'LocalizationController@change')->name('change-locale');
Route::get('/localization', 'LocalizationController@get');