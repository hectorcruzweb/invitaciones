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

/*Route::get('/', function () {
    return view('welcome');
})->name('profile');
*/




Auth::routes(['register' => false]);



Route::get('/invitacion/{data?}', 'HomeController@invitacion')->name('invitacion');
Route::get('/', 'HomeController@index')->name('index1');



Route::post('submit-form', 'HomeController@confirmar');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@home')->name('home');
});
