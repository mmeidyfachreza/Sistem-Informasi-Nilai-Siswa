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

Route::get('tes','HomeController@query');
Auth::routes();

Route::group(['prefix' => 'siswa'], function () {
    Route::get('/home', 'HomeController@index')->name('home'); 
    Route::get('/raport','HomeController@indexRaport')->name('index.raport.siswa');
    Route::get('/cetak-raport/{id}','HomeController@printRaport')->name('print.raport.siswa');
});

Route::get('raport', 'RaportController@cetak');
Route::get('/','GuruController@index')->middleware('guru');

Route::group(['middleware'=>'guru', 'prefix' => 'admin'], function () {
    Route::get('/','GuruController@index');
    Route::resource('guru', 'GuruController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('jurusan', 'JurusanController');
    Route::resource('matapelajaran', 'MatapelajaranController');
    Route::resource('kelas', 'KelasController');
    Route::resource('nilai-akademik', 'NilaiakademikController');
    Route::resource('raport', 'RaportController')->except('create');
    Route::resource('ekskul', 'EkskulController');
    Route::resource('pkl', 'PKLController');

    Route::get('raport/create/{id}', 'RaportController@create')->name('raport.create');
    Route::get('nilai-akademik/siswa/{id}', 'NilaiakademikController@indexNilai')->name('cari.nilai.siswa');
    Route::get('raport/siswa/{id}', 'RaportController@indexNilai')->name('cari.raport.siswa');
    Route::get('nilai-akademik/create/{id}', 'NilaiakademikController@create')->name('nilai.siswa.create');
    Route::post('nilai-akademik/find-semester', 'NilaiakademikController@orderBySemester')->name('nilai.siswa.semester');
    Route::post('nilai-akademik/find-semester-edit/{id}', 'NilaiakademikController@orderBySemesterEdit')->name('nilai.siswa.semester2');
});