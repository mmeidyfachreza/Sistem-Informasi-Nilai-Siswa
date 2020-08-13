<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $table = 'raport';
    protected $fillable = [
        'siswa_id',
        'semester_id',
        'matapelajaran_id',
        'total_nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'bobot_nilai',
        'predikat'
    ];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function matapelajaran()
    {
        return $this->belongsTo('App\Matapelajaran');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }
}
