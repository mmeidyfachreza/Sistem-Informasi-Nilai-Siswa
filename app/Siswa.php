<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'nis','nisn','nama','tempat_lahir','tanggal_lahir','alamat','jenis_kelamin','nohp',
        'kelas_id',
        'jurusan_id',
        'tanggal_masuk',
        'angkatan_thn',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function raport()
    {
        return $this->hasMany('App\Raport');
    }

    public function nilai_akademik()
    {
        return $this->hasMany('App\Nilaiakademik');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan');
    }
}
