<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = ['nama'];

    public function prodi()
    {
        return $this->hasMany('App\Prodi');
    }
}
