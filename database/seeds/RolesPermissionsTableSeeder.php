<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_permissions = array(
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],

            ['role_id' => 2, 'permission_id' => 1],
            ['role_id' => 2, 'permission_id' => 4],
            ['role_id' => 2, 'permission_id' => 6],
            ['role_id' => 2, 'permission_id' => 8],

            ['role_id' => 3, 'permission_id' => 2],
            ['role_id' => 3, 'permission_id' => 9],

            ['role_id' => 4, 'permission_id' => 2],
            ['role_id' => 4, 'permission_id' => 10],

            ['role_id' => 5, 'permission_id' => 5],
            ['role_id' => 5, 'permission_id' => 11],

            ['role_id' => 6, 'permission_id' => 10],

            ['role_id' => 7, 'permission_id' => 3],
            ['role_id' => 7, 'permission_id' => 4],
            ['role_id' => 7, 'permission_id' => 6],
            ['role_id' => 7, 'permission_id' => 12],

            ['role_id' => 8, 'permission_id' => 3],
            ['role_id' => 8, 'permission_id' => 4],
            ['role_id' => 8, 'permission_id' => 6],
            ['role_id' => 8, 'permission_id' => 10],
        );
        DB::table('roles_permissions')->truncate();
        DB::table('roles_permissions')->insert($roles_permissions);
    }
}
