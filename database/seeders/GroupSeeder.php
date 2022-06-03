<?php

namespace Database\Seeders;
use App\Models\Group;

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupList = [
            [
                'package_size' => 1, 
                'name' => 'group 1', 
                'description' => 'description', 
                'hour_limit' => 0
            ],
            [
                'package_size' => 1, 
                'name' => 'group 2', 
                'description' => 'description', 
                'hour_limit' => 0
            ],
            [
                'package_size' => 1, 
                'name' => 'group 3', 
                'description' => 'description', 
                'hour_limit' => 0
            ],
            [
                'package_size' => 1, 
                'name' => 'group 4', 
                'description' => 'description', 
                'hour_limit' => 0
            ],
            [
                'package_size' => 1, 
                'name' => 'group 5', 
                'description' => 'description', 
                'hour_limit' => 0
            ],
        ];

        foreach ($groupList as $item) {
            Group::insert($item);
        }
    }
}
