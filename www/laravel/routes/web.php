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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/', 'TopController@index')->name('top');
Route::get('/addbook', 'TopController@index')->name('addbook');
Route::post('/addbook', 'PostController@addbook');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/book/lend/{book_id}', 'BookController@lend');
Route::post('/api/book/lend/{book_id}', 'BookController@lend');
Route::get('/api/book/return/{book_id}', 'BookController@returnBook');
Route::post('/api/book/return/{book_id}', 'BookController@returnBook');
