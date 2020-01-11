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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/login', 'PagesController@login');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'PagesController@index');
Route::post('/logout', 'LoginController@logout');
Route::get('/dashboard', 'DashboardController@index');
Route::post('/authors/subscribe', 'AuthorsController@subscribe');
Route::post('/authors/unsubscribe', 'AuthorsController@unsubscribe');

Route::resource('authors', 'AuthorsController');
Route::resource('articles', 'ArticlesController');
