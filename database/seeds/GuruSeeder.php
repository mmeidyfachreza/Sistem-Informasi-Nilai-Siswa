<?php

use App\Guru;
use App\User;
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
        $user = User::all();
        foreach ($user as $value) {
            Guru::create([
                'nip' => '1234567890',
                'nama' => str_replace('@admin.com','',$value->email),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'alamat' => $faker->address,
                'nohp' => $faker->e164PhoneNumber,
                'user_id' => $value->id,
            ]);
        }
    }
}
