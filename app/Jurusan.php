<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama','kode_jurusan'];

    public function kelas()
    {
        return $this->hasMany('App\Kelas','kelas_id','guru_id');
    }
}
