<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('123'),
            ]);
        for ($i=0; $i < 10 ; $i++) { 
            User::create([
                'email' => $faker->firstName().'@admin.com',
                'password' => Hash::make('123'),
                ]);
        }
    }
}
