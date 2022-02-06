<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'user_name' => 'datis1',
            'first_name' => 'hamid',
            'last_name' => 'koohpeyma',
            'father_name' => 'ali',
            'birthday' => Carbon::create('2000', '01', '01'),
            'address' => 'my address',
            'phone' => '0123456789',
            'personalCode' => '0123456789',
            'meli_code' => '987456123',
            'gender' => 'male',
            'email' => 'user@gmail.com',
            'org_email' => 'email@university.com',
            'password' => bcrypt('password'),
            'major' => 'doctor',
            'passport' => '123456789',
            'exp_date' => Carbon::create('2020', '01', '01'),
            'hour_limit' => '8',
            'connection_number' => '8',
        ]);
    }
}
