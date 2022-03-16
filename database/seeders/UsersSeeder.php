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

        $userList = [
            [
                'group_id' => '1',
                'user_name' => 'datis1',
                'first_name' => 'hamid',
                'last_name' => 'koohpeyma',
                'father_name' => 'ali',
                'birthday' => Carbon::create('2000', '01', '01'),
                'address' => 'my address',
                'phone' => '0123456789',
                'personal_code' => '0123456789',
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
                'static_ip' => '1.1.1.1',
            ],
            [
                'group_id' => '1',
                'user_name' => 'datis2',
                'first_name' => 'hamid',
                'last_name' => 'koohpeyma',
                'father_name' => 'ali',
                'birthday' => Carbon::create('2000', '01', '01'),
                'address' => 'my address',
                'phone' => '0123456789',
                'personal_code' => '0123456789',
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
                'static_ip' => '1.1.1.2',
            ],
            [
                'group_id' => '2',
                'user_name' => 'datis3',
                'first_name' => 'hamid',
                'last_name' => 'koohpeyma',
                'father_name' => 'ali',
                'birthday' => Carbon::create('2000', '01', '01'),
                'address' => 'my address',
                'phone' => '0123456789',
                'personal_code' => '0123456789',
                'meli_code' => '987456123',
                'gender' => 'male',
                'email' => 'user@gmail.com',
                'org_email' => 'email@university.com',
                'password' => bcrypt('password'),
                'major' => 'doctor',
                'passport' => '123456789',
                'exp_date' => Carbon::create('2020', '01', '01'),
                'ip_exp_date' => Carbon::create('2022', '01', '02'),
                'hour_limit' => '8',
                'connection_number' => '8',
                'static_ip' => '1.1.1.3',
            ],
            [
                'group_id' => '2',
                'user_name' => 'datis4',
                'first_name' => 'hamid',
                'last_name' => 'koohpeyma',
                'father_name' => 'ali',
                'birthday' => Carbon::create('2000', '01', '01'),
                'address' => 'my address',
                'phone' => '0123456789',
                'personal_code' => '0123456789',
                'meli_code' => '987456123',
                'gender' => 'male',
                'email' => 'user@gmail.com',
                'org_email' => 'email@university.com',
                'password' => bcrypt('password'),
                'major' => 'doctor',
                'passport' => '123456789',
                'exp_date' => Carbon::create('2020', '01', '01'),
                'ip_exp_date' => Carbon::create('2022', '04', '02'),
                'hour_limit' => '8',
                'connection_number' => '8',
                'static_ip' => '1.1.1.4',
            ],
            [
                'group_id' => '2',
                'user_name' => 'datis5',
                'first_name' => 'hamid',
                'last_name' => 'koohpeyma',
                'father_name' => 'ali',
                'birthday' => Carbon::create('2000', '01', '01'),
                'address' => 'my address',
                'phone' => '0123456789',
                'personal_code' => '0123456789',
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
            ],
            [
                'group_id' => '3',
                'user_name' => 'datis6',
                'first_name' => 'hamid',
                'last_name' => 'koohpeyma',
                'father_name' => 'ali',
                'birthday' => Carbon::create('2000', '01', '01'),
                'address' => 'my address',
                'phone' => '0123456789',
                'personal_code' => '0123456789',
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
            ]
        ];

        foreach ($userList as $item) {
            User::insert($item);
        }
        
    }
}
