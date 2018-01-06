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

//middleware
Route::group(['middleware' => ['web']], function()
{
    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*');
    //Route::get('/', 'TestController@index');
});


Route::get('/', function () {
    return view('welcome');
});
