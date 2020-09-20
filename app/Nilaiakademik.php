<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilaiakademik extends Model
{
    protected $table = 'nilaiakademik';
    protected $fillable = [
        'tahun',
        'angkatan',
        'semester',
        'siswa_id',
        'nama_kelas',
        'nama_jurusan',
        'nomor_kelas',
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

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }

    public function raport()
    {
        return $this->hasOne('App\Raport');
    }

}
