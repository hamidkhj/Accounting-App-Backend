<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
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
                "name" => 'VPN',
                'search_name' => 'VPN',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'Email',
                'search_name' => 'Email',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'Local VPN',
                'search_name' => 'Local',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'Hotspot',
                'search_name' => 'Hot',
                "description" => 'توضیحات'
            ],
        ];

        foreach ($items as $item) {
            Service::insert($item);
        }
    }
}
