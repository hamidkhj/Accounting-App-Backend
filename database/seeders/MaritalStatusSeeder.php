<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaritalStatus;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                "name" => 'مجرد',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'متعهل',
                "description" => 'توضیحات'
            ],
        ];

        foreach ($items as $item) {
            MaritalStatus::insert($item);
        }
    }
}
