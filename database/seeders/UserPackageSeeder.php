<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPackage;
use Carbon\Carbon;

class UserPackageSeeder extends Seeder
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
                'package_id' => 1,
                'user_id' => 1,
                'name' => 'ّبسته 1',
                'expiration_date' => Carbon::create('2000', '01', '01'),
                'purchase_date' => Carbon::now(),
                'remaining_megabyte' => 1000,
                'priority' => 1,
                'receipt_number' => 10001,
                'price' => 20000,
                'payment_type' => 'online',
                'size' => 3000,
                'duration' => 10,
            ],
            [
                'package_id' => 1,
                'user_id' => 1,
                'name' => 'ّبسته 1',
                'expiration_date' => Carbon::create('2000', '01', '01'),
                'purchase_date' => Carbon::create('2000', '01', '01'),
                'remaining_megabyte' => 1000,
                'priority' => 1,
                'receipt_number' => 10001,
                'price' => 20000,
                'payment_type' => 'online',
                'size' => 3000,
                'duration' => 10,
            ],
            [
                'package_id' => 1,
                'user_id' => 2,
                'name' => 'ّبسته 2',
                'expiration_date' => Carbon::create('2000', '01', '01'),
                'purchase_date' => Carbon::create('2000', '01', '01'),
                'remaining_megabyte' => 1000,
                'priority' => 1,
                'receipt_number' => 10001,
                'price' => 20000,
                'payment_type' => 'online',
                'size' => 3000,
                'duration' => 10,
            ],
            [
                'package_id' => 1,
                'user_id' => 2,
                'name' => 'بسته 3',
                'expiration_date' => Carbon::create('2000', '01', '01'),
                'purchase_date' => Carbon::create('2000', '01', '01'),
                'remaining_megabyte' => 1000,
                'priority' => 1,
                'receipt_number' => 10001,
                'price' => 20000,
                'payment_type' => 'online',
                'size' => 3000,
                'duration' => 10,
            ],
            [
                'package_id' => 1,
                'user_id' => 1,
                'name' => 'ّبسته 4',
                'expiration_date' => Carbon::create('2000', '01', '01'),
                'purchase_date' => Carbon::create('2000', '01', '01'),
                'remaining_megabyte' => 1000,
                'priority' => 1,
                'receipt_number' => 10001,
                'price' => 20000,
                'payment_type' => 'online',
                'size' => 3000,
                'duration' => 10,
            ],
        ];

        foreach ($list as $item) {
            UserPackage::insert($item);
        }
    }
}

