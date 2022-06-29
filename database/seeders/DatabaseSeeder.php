<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // PermissionsTableSeeder::class,
            // RolesTableSeeder::class,
            // ConnectRelationshipsSeeder::class,
            // GroupSeeder::class,
            // UsersSeeder::class,
            // PackageTypeTableSeeder::class,
            // TitleSeeder::class,
            // MaritalStatusSeeder::class,
            // ServiceSeeder::class,
            // UserPackageSeeder::class,
            ConnectionLogSeeder::class,
            // ActionLogSeeder::class,
            // CallsLogSeeder::class,
            // PackageTableSeeder::class,
        ]);
    }
}
