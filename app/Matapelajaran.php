<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    protected $table = 'matapelajaran';
    protected $fillable = ['nama','semester','idguru'];

    public function raport()
    {
        return $this->hasMany('App\Raport');
    }
}
