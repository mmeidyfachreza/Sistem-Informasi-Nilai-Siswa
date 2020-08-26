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

    public function hasilEkskul()
    {
        return $this->belongsToMany('App\Ekskul','hasil_ekskul','ekskul_siswa_id','ekstrakurikuler_id')
                    ->withPivot('keterangan')
                    ->withTimestamps();
    }

    public function raport()
    {
        return $this->hasOne('App\Raport');
    }
}
