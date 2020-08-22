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
        $data = ['Jaringan','Desain Grafis','Rekayasa Perangkat Lunak','Hardware','Data Mining','Keamanan Jaringan'];
        foreach ($data as $value) {
            Jurusan::create(['nama'=>$value]);
        }
    }
}
