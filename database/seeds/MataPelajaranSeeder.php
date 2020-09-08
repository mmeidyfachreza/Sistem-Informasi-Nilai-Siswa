<?php

use Illuminate\Database\Seeder;
use App\Matapelajaran;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Pendidikan Agama Islam',
            'Pendidikan Pancasila dan Kewarganegaraan',
            'Bahasa Indonesia',
            'Matematika',
            'Sejarah Indonesia',
            'Bahasa Inggris dan Bahasa Asing Lainnya',
            'Seni Budaya',
            'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
            'Simulasi dan Komunikasi Digital',
            'Fisika',
            'Kimia',
            'Gambar Teknik',
            'Dasar listrik dan Elektronika',
            'Tek Pemrograman Microprosessor dan Microcontroller',
        ];
        foreach ($data as $value) {
            Matapelajaran::create([
                'nama'=>$value,
                'semester'=>1,
                'guru_id'=>rand(1,10),
            ]);
        }
    }
}
