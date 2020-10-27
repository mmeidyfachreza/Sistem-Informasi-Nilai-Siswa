<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $table = 'raport';
    protected $fillable = [
        'nilaiakademik_id',
        'pkl_siswa_id',
        'ekskul_siswa_id',
        'cat_akademik',
        'peringkat',
        'sakit',
        'izin',
        'tanpa_ket',
        'keterangan_kenaikan',
        'guru_id',
    ];

    public function nilaiAkademik()
    {
        return $this->belongsTo('App\Nilaiakademik','nilaiakademik_id');
    }

    public function PKLSiswa()
    {
        return $this->belongsTo('App\PKLSiswa','pkl_siswa_id');
    }

    public function ekskulSiswa()
    {
        return $this->belongsTo('App\EkskulSiswa','ekskul_siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo('App\Guru','guru_id');
    }
}
