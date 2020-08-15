<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    protected $table = 'matapelajaran';
    protected $fillable = ['nama','semester','guru_id'];

    public function raport()
    {
        return $this->hasMany('App\Raport');
    }

    public function guru()
    {
        return $this->belongsTo('App\Guru','guru_id');
    }
}
