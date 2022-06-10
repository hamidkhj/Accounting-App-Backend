<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\UserPackage;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $list = [
                '03-21',
                '04-21',
                '05-22',
                '06-22',
                '07-23',
                '08-23',
                '09-23',
                '10-23',
                '11-22',
                '12-22',
                '01-21',
                '02-20',
            ];

            $month = 0;
            foreach ($list as $idx=>$item) {
                if (Carbon::now()->format("m-d") == $item){
                    $month = $idx;
                }
            }

            // package id = 0 shows free monthly packages
            if($month != 0){
                $duration = ($month > 6) ? 30 : 31;
                $users = User::with('group')->get();
                foreach($users as $user){
                    if($user->group->package_size > 0) {
                        UserPackage::create([
                            'package_id' => 0,
                            'user_id' => $user->id,
                            'name' => 'ّرایگان ماهانه',
                            'expiration_date' => Carbon::now()->addDays($duration),
                            'purchase_date' => Carbon::now(),
                            'remaining_megabyte' => $user->group->package_size,
                            'priority' => 1,
                            'receipt_number' => 0,
                            'price' => 0,
                            'payment_type' => 'free',
                            'size' => $user->group->package_size,
                            'duration' => $duration,
                        ]);
                    }
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
