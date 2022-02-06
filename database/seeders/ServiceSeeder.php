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
                "description" => 'توضیحات'
            ],
            [
                "name" => 'Email',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'Local VPN',
                "description" => 'توضیحات'
            ],
            [
                "name" => 'Hotspot',
                "description" => 'توضیحات'
            ],
        ];

        foreach ($items as $item) {
            Service::insert($item);
        }
    }
}
