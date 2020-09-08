<?php

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
        $data = ['X','XI','XII'];
        foreach ($data as $value) {
            Kelas::create(['nama'=>$value,'jurusan_id'=>rand(1,6),'nomor'=>rand(1,3),'guru_id'=>rand(1,10)]);
        }
    }
}
