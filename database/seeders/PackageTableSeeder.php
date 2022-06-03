<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageTableSeeder extends Seeder
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
                'package_type_id' => 1,
                'name' => 'package 1',
                'description' => 'some description for 1',
                'duration' => 30,
                'size' => 2000,
                'price' => 1000,
                'is_for_sale' => 1
            ],
            [
                'package_type_id' => 1,
                'name' => 'package 2',
                'description' => 'some description for 2',
                'duration' => 30,
                'size' => 2000,
                'price' => 2000,
                'is_for_sale' => 1
            ],
            [
                'package_type_id' => 1,
                'name' => 'package 3',
                'description' => 'some description for 3',
                'duration' => 30,
                'size' => 2000,
                'price' => 3000,
                'is_for_sale' => 0
            ],
        ];


        foreach($list as $item) {
            Package::create($item);
        }
    }
}
