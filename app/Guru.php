<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['nip','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','guru_id');
    }

    public function matapelajaran()
    {
        return $this->hasMany('App\Matapeljaran');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas','kelas_id','guru_id');
    }
}
