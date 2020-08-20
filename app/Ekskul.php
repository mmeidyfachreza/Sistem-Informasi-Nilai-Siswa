<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekstrakurikuler';
    protected $fillable = ['nama'];

    public function ekskulSiswa()
    {
        return $this->belongsToMany('App\EkskulSiswa');
    }
}
