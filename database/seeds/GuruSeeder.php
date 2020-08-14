<?php

use App\Guru;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        Guru::create([
            'nip' => '1234567890',
            'nama' => $faker->name,
            'tempat_lahir' => $faker->city,
            'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'alamat' => $faker->address,
            'nohp' => $faker->e164PhoneNumber,
            'user_id' => 1,
        ]);
    }
}
