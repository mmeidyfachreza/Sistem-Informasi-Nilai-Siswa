<?php

use App\Kepsek;
use Illuminate\Database\Seeder;

class KepsekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kepsek::create(['nama'=>'HJ SITTI AISYAH, S.PD,SH,MM,MH','NIP'=>'196909121998022044']);
    }
}
