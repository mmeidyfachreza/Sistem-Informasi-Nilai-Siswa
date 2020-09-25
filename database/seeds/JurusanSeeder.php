<?php

use Illuminate\Database\Seeder;
use App\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Akomodasi Perhotelan','Akuntansi','Multimedia','Sekretaris','Teknik Alat Berat','Teknik Jaringan Komputer'];
        foreach ($data as $value) {
            Jurusan::create(['nama'=>$value]);
        }
    }
}
