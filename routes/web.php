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

Route::get('/', ['as' => 'home',
    'uses' => 'IndexController@index']);
Route::get('/getIpFromUrl', ['as' => 'get.ip.from.url',
    'uses' => 'IndexController@getIpFromUrl']);
Route::get('/{ip}', ['as' => 'view.ip',
    'uses' => 'IndexController@viewIp']);