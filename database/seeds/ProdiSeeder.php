<?php

use App\Jurusan;
use Illuminate\Database\Seeder;
use App\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Teknik Informatika','Ilmu Komputer','Sistem Informasi'];
        foreach ($data as $value) {
            Prodi::create(['nama'=>$value]);
        }
    }
}
