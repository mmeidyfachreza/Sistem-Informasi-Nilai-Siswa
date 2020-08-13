<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $fillable = ['semester'];

    public function raport()
    {
        return $this->hasMany('App\Raport');
    }
}
