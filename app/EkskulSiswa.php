<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EkskulSiswa extends Model
{
    protected $table = 'ekskul_siswa';
    protected $fillable = [
        'tahun',
        'semester',
        'siswa_id',        
    ];

    public function hasilPKL()
    {
        return $this->belongsToMany('App\Ekstrakurikuler','ekskul_siswa','ekskul_siswa_id','ekstrakurikuler_id')
                    ->withPivot('keterangan')
                    ->withTimestamps();
    }
}
