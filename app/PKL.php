<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    protected $table = 'pkl';
    protected $fillable = ['mitra','lokasi'];

    public function PKLSiswa()
    {
        return $this->belongsToMany('App\PKLSiswa');
    }
}
