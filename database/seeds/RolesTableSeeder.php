<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            // ['name' => 'super_admin'],
            // ['name' => 'admin'],
            // ['name' => 'client_user'],
            // ['name' => 'client_restricted_user'],
            // ['name' => 'owner_user'],
            // ['name' => 'owner_restricted_user'],
            // ['name' => 'user_abcn_personnel'],
            // ['name' => 'restricted_user_abcn_personnel'],
            ['name' => 'allwork_user']
        );
        //DB::table('roles')->truncate();
        DB::table('roles')->insert($roles);
    }
}
