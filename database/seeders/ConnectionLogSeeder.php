<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\ConnectionLog;

class ConnectionLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'user_id' => 1, 
                'log_date'=> Carbon::now()->addDays(2),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'VPN ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 1, 
                'log_date'=> Carbon::now()->subDays(2),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'Local ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 1, 
                'log_date'=> Carbon::now()->subDays(3),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'Local ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 1, 
                'log_date'=> Carbon::now()->addDays(1),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'Hot ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 2, 
                'log_date'=> Carbon::now(),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'Hot ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 2, 
                'log_date'=> Carbon::now(),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'VPN ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 2, 
                'log_date'=> Carbon::now()->addDays(5),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'Hot ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
            [
                'user_id' => 2, 
                'log_date'=> Carbon::now()->addDays(4),
                'gateway' => '127.127.14.29',
                'address' => '127.127.14.29',
                'line' => 'Local ssss', 
                'duration' => '120',
                'bytes_in' => '400000',
                'bytes_out' => '400000',
                'disc_cause' => 'some reason',
                'details' => 'some information is going to be here'
            ],
        ];

        foreach($list as $item) {
            ConnectionLog::insert($item);
        }
    }
}
