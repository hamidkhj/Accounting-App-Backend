<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            [
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Users',
                'slug'        => 'create.users',
                'description' => 'Can create new users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Users',
                'slug'        => 'edit.users',
                'description' => 'Can edit users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Search Users',
                'slug'        => 'search.users',
                'description' => 'Can search users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Password For Users',
                'slug'        => 'editPassword.users',
                'description' => 'Can change password for users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View User Reports',
                'slug'        => 'view.userReports',
                'description' => 's',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Groups',
                'slug'        => 'edit.groups',
                'description' => 'Can edit groups',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Locations',
                'slug'        => 'edit.locations',
                'description' => 'Can edit locations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Packages',
                'slug'        => 'edit.packages',
                'description' => 'Can edit packages',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Services',
                'slug'        => 'edit.services',
                'description' => 'Can edit services',
                'model'       => 'Permission',
            ],
            // [
            //     'name'        => 'Can Search Users',
            //     'slug'        => 'search.users',
            //     'description' => 'Can search users',
            //     'model'       => 'Permission',
            // ],
            [
                'name'        => 'Can View Reports',
                'slug'        => 'view.reports',
                'description' => 's',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View IP Report',
                'slug'        => 'view.ipReport',
                'description' => 's',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Bank Report',
                'slug'        => 'view.bankReport',
                'description' => 's',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View PurchasedPackages Report',
                'slug'        => 'view.purchasedPackagesReport',
                'description' => 's',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Send Message',
                'slug'        => 'send.message',
                'description' => 's',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Send Group Message',
                'slug'        => 'send.groupmessage',
                'description' => 's',
                'model'       => 'Permission',
            ],
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
