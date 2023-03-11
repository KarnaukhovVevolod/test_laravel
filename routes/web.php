<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->match(['get','post'],'/create','\App\Http\Controllers\CrudController@save');

Route::middleware('auth:sanctum')->match(['get','post'],'/update/{id}','\App\Http\Controllers\CrudController@update');

Route::match(['get','post'],'/viewDelete','\App\Http\Controllers\CrudController@viewDelete');

Route::match(['post'],'/delete/{id}','\App\Http\Controllers\CrudController@delete');

Route::get('/testing', function () {
    return view('testing');
});
