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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','GuruController@index')->middleware('guru');

Route::group(['middleware'=>'guru', 'prefix' => 'admin'], function () {
    Route::get('/','GuruController@index');
    Route::resource('guru', 'GuruController');
    Route::resource('siswa', 'SiswaController');
});
