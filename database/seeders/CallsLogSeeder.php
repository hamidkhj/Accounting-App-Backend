<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CallsLog;
use Carbon\Carbon;

class CallsLogSeeder extends Seeder
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
                'log_date' => Carbon::now()->addDays(2),
                'nas' => '1.1.1.1',
                'port' => '2.2.2.2',
                'status' => 'stat',
                'reason' => 'invalid pass',
                'detail' => 'some detail goes here',
                'fa_why' => 'توضیح فارسی',
            ],
            [
                'user_id' => 1,
                'log_date' => Carbon::now()->addDays(3),
                'nas' => '1.1.1.1',
                'port' => '2.2.2.2',
                'status' => 'stat',
                'reason' => 'invalid pass',
                'detail' => 'some detail goes here',
                'fa_why' => 'توضیح فارسی',
            ],
            [
                'user_id' => 2,
                'log_date' => Carbon::now()->addDays(1),
                'nas' => '1.1.1.1',
                'port' => '2.2.2.2',
                'status' => 'stat',
                'reason' => 'invalid pass',
                'detail' => 'some detail goes here',
                'fa_why' => 'توضیح فارسی',
            ],
            [
                'user_id' => 3,
                'log_date' => Carbon::now()->addDays(2),
                'nas' => '1.1.1.1',
                'port' => '2.2.2.2',
                'status' => 'stat',
                'reason' => 'invalid pass',
                'detail' => 'some detail goes here',
                'fa_why' => 'توضیح فارسی',
            ],
            [
                'user_id' => 3,
                'log_date' => Carbon::now()->addDays(2),
                'nas' => '1.1.1.1',
                'port' => '2.2.2.2',
                'status' => 'stat',
                'reason' => 'invalid pass',
                'detail' => 'some detail goes here',
                'fa_why' => 'توضیح فارسی',
            ],
        ];

        foreach($list as $item) {
            CallsLog::insert($item);
        }
    }
}
