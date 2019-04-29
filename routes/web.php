<?php
use App\Animal; //using eloquent, allows us to do database queries in other then SQL.
use App\User;
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



Route::get('/animal_user_change_status/{animal_id}/attach', 'Animal_usersController@attach');
Route::get('/animal_user_change_status/{animal_id}/{user_id}/detach', 'Animal_usersController@detach');
Route::get('/animal_user_change_status/{animal_id}/{user_id}/Accept', 'Animal_usersController@setAcceptToStatusColumn');
Route::get('/animal_user_change_status/{animal_id}/{user_id}/Reject', 'Animal_usersController@setRejectToStatusColumn');
Route::get('/viewuserdata', 'Animal_usersController@viewUserData');
Route::get('/viewanimalsdata', 'Animal_usersController@viewAnimalData');

Route::get('/', 'AnimalController@index'); // just incase anything redricts to '/'
Route::resource('Animal', 'AnimalController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

