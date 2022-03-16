<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActionLog;
use Carbon\Carbon;

class ActionLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $list = [
            [
                'user_id' => 1,
                'target_id' => 2,
                'log_type' => 'edit account',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.1',
                'created_at' => Carbon::now()->addDays(1),
            ],
            [
                'user_id' => 1,
                'target_id' => 2,
                'log_type' => 'delete',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.1',
                'created_at' => Carbon::now()
            ],
            [
                'user_id' => 1,
                'log_type' => 'search',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.1',
                'created_at' => Carbon::now()->addDays(3),
            ],
            [
                'user_id' => 3,
                'log_type' => 'create package',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.3',
                'created_at' => Carbon::now()->addDays(4),
            ],
            [
                'user_id' => 3,
                'target_id' => 2,
                'log_type' => 'edit account',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.3',
                'created_at' => Carbon::now()->addDays(5),
            ],
            [
                'user_id' => 1,
                'target_id' => 4,
                'log_type' => 'edit account',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.1',
                'created_at' => Carbon::now()->addDays(4),
            ],
            [
                'user_id' => 1,
                'target_id' => 3,
                'log_type' => 'edit account',
                'detail' => 'some detail about this action',
                'admin_ip' => '1.1.1.1',
                'created_at' => Carbon::now()->addDays(3),
            ],
        ];

        foreach ($list as $item ) {
            ActionLog::insert($item);
        }
    }
}

