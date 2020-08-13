<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama','prodi_id','walikelas_id'];

    public function walikelas()
    {
        return $this->belongsTo('App\Walikelas');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Prodi');
    }
}
