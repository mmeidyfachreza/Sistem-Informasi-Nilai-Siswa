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
    Route::get('/akun/{id}','SiswaController@akun')->name('akun.siswa.show');
    Route::post('/akun/ubah/{id}','SiswaController@updateAkun')->name('akun.siswa.update');
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
    Route::resource('nilai-akademik', 'NilaiakademikController')->except('create');
    Route::resource('raport', 'RaportController')->except('create');
    Route::resource('ekskul', 'EkskulController');
    Route::resource('pkl', 'PKLController');
    Route::get('/akun/{id}','GuruController@akun')->name('akun.guru.show');
    Route::post('/akun/ubah/{id}','GuruController@updateAkun')->name('akun.guru.update');

    Route::get('raport/create/{id}', 'RaportController@create')->name('raport.create');
    Route::get('raport/kelas/{kelas}/nilai-akademik', 'RaportController@indexNilai')->name('raport.index.nilai');
    Route::get('raport/kelas/{kelas}/nilai-akademik/tambah', 'RaportController@createNilai')->name('raport.create.nilai');
    Route::get('raport/kelas/{kelas}/nilai-akademik/buat', 'RaportController@generateNilai')->name('raport.generate.nilai');
    Route::post('raport/kelas/{id}/nilai-akademik/cek', 'RaportController@checkNilai')->name('raport.check.nilai');
    Route::post('raport/kelas/{id}/nilai-akademik/generate', 'RaportController@generateNilai')->name('raport.generate.nilai');
    Route::post('raport/kelas/{kelas}/nilai-akademik/detail', 'RaportController@detailNilai')->name('raport.detail.nilai');

    Route::get('nilai-akademik/siswa/{id}', 'NilaiakademikController@indexNilai')->name('cari.nilai.siswa');
    Route::get('nilai-akademik/kelas/{kelas}/mapel/', 'NilaiakademikController@indexMapel')->name('nilai.mapel.index');
    Route::get('nilai-akademik/kelas/{kelas}/mapel/{mapel}', 'NilaiakademikController@indexNilai')->name('nilai.index2');
    Route::post('nilai-akademik/kelas/{kelas}/mapel/{mapel}/tambah', 'NilaiakademikController@create')->name('nilai-akademik.create');
    Route::get('raport/siswa/{id}', 'RaportController@indexNilai')->name('cari.raport.siswa');
    Route::get('nilai-akademik/create/{id}', 'NilaiakademikController@create')->name('nilai.siswa.create');
    Route::post('nilai-akademik/find-semester', 'NilaiakademikController@orderBySemester')->name('nilai.siswa.semester');
    Route::post('nilai-akademik/find-semester-edit/{id}', 'NilaiakademikController@orderBySemesterEdit')->name('nilai.siswa.semester2');

    Route::get('kepsek','HomeController@kepsekForm')->name('kepsek.show');
    Route::post('kepsek/update','HomeController@kepsekUpdate')->name('kepsek.update');
});
