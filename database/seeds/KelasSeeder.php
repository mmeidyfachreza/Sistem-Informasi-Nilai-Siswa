<?php

use App\Jurusan;
use Illuminate\Database\Seeder;
use App\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData = array(
            'X' => array(1),
            // 'XI' => array(1),
            // 'XII' => array(1),
        );
        foreach (Jurusan::all() as $value) {
            foreach ($arrayData as $nama => $data) {
                foreach ($data as $nomor) {
                    Kelas::create(['nama'=>$nama,'jurusan_id'=>$value->id,'nomor'=>$nomor,'guru_id'=>rand(1,10)]);
                }
            }
        }
    }
}
