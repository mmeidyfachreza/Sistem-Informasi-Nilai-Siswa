<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PKLSiswa extends Model
{
    protected $table = 'pkl_siswa';
    protected $fillable = [
        'tahun',
        'semester',
        'siswa_id',        
    ];

    public function hasilPKL()
    {
        return $this->belongsToMany('App\PKL','hasil_pkl','pkl_siswa_id','pkl_id')
                    ->withPivot('lamanya')
                    ->withPivot('keterangan')
                    ->withTimestamps();
    }

    public function raport()
    {
        return $this->hasOne('App\Raport');
    }
}
