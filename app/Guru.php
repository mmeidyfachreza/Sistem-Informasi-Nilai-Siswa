<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = [
        'nip','nama','tempat_lahir','tanggal_lahir','alamat','jenis_kelamin','nohp','jabatan'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function matapelajaran()
    {
        return $this->hasMany('App\Matapeljaran');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas');
    }

    public function raport()
    {
        return $this->hasMany('App\Raport');
    }
}
