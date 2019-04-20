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

Route::get('/', 'PagesController@index'); //Calls index method in controller and that method routes to index page. All routes go through conroller
//Route::get('/', 'PagesController@index');

Route::resource('Animal', 'AnimalController');