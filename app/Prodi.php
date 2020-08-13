<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $fillable = ['jurusan_id','nama','kode_label_prodi','kode_jurusan_prodi'];

    public function kelas()
    {
        return $this->hasMany('App\Kelas');
    }

    public function siswa()
    {
        return $this->hasOne('App\Siswa');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan');
    }

}
