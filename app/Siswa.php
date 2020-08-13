<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'user_id',
        'kelas_id',
        'prodi_id',
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
}
