<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Title;

class TitleSeeder extends Seeder
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
                "name" => 'آقای',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'خانم',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'دکتر',
                "description" => 'توضیحات'
            ],
        ];

        foreach ($items as $item) {
            Title::insert($item);
        }
    }
    
}
