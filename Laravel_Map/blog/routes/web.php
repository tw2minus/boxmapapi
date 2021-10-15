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

Route::get('/mapdata', 'App\Http\Controllers\MapController@index')->name('boxmap.index');
Route::get('/mapdata/search','App\Http\Controllers\MapController@search')->name('search');
Route::get('/','App\Http\Controllers\MapController@view');

