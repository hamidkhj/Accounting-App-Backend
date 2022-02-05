<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PackageType;

class PackageTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageType::insert([
            "name"=> 'نوع پیش فرض',
            'priority' => '10',
            'description' => 'این نوع پیش فرض بسته اینترنتی است',
        ]);
    }
}
