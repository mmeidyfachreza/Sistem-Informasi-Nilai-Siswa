<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = ['nama','prodi_id','guru_id'];

    public function guru()
    {
        return $this->belongsTo('App\Guru','guru_id');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Prodi','prodi_id');
    }
}
