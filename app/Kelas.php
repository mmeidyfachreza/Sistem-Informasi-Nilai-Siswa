<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama','jurusan_id','guru_id','nomor'];

    public function guru()
    {
        return $this->belongsTo('App\Guru','guru_id');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan','jurusan_id');
    }

    public function siswa()
    {
        return $this->hasOne('App\Siswa');
    }
}
