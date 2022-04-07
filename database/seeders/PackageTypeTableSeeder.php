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
            "name"=> 'بسته رایگان',
            'priority' => '1',
            'description' => 'بسته رایگان ماهانه',
        ]);
    }
}
