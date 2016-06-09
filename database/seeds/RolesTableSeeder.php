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
            ['name' => 'super_admin','id' =>1],
            ['name' => 'admin', 'id' =>2],
            ['name' => 'client_user', 'id' =>3],
            ['name' => 'client_restricted_user', 'id' =>4],
            ['name' => 'owner_user', 'id' =>5],
            ['name' => 'owner_restricted_user', 'id' =>6],
            ['name' => 'user_abcn_personnel', 'id' =>7],
            ['name' => 'restricted_user_abcn_personnel', 'id' =>8],
            ['name' => 'allwork_user', 'id' =>9]
        );
        //DB::table('roles')->truncate();
        DB::table('roles')->insert($roles);
    }
}
