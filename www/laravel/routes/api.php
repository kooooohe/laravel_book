<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/books', 'BookController@show');
Route::post('/books', 'BookController@show');
Route::post('/addbook', 'PostController@addbook');
//Route::get('/books/lend', 'BookController@lend');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    //Route::post('/books/lend', 'BookController@lend');
    return $request->user();
});
