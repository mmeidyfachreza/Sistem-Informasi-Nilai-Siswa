<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilaiakademik extends Model
{
    protected $table = 'nilaiakademik';
    protected $fillable = [
        'tahun',
        'semester',
        'siswa_id',
        'sum_pengetahuan',
        'sum_keterampilan',
        'sum_nilai_akhir',
        'avg_pengetahuan',
        'avg_keterampilan',
        'avg_nilai_akhir',
        'avg_predikat',
    ];

    public function nilaiMaPel()
    {
        return $this->belongsToMany('App\Matapelajaran','nilai_mapel','nilaiakademik_id','matapelajaran_id')
                    ->withPivot('pengetahuan')
                    ->withPivot('keterampilan')
                    ->withPivot('nilai_akhir')
                    ->withPivot('predikat')
                    ->withTimestamps();
    }
}
