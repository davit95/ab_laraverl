<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            ['name' => 'ccp_access_to_owned_and_all_client_accounts'],
            ['name' => 'ccp_yes'],
            ['name' => 'ccp_access_to_all_client_accounts'],
            ['name' => 'ocp_access_to_all'],
            ['name' => 'ocp_yes'],
            ['name' => 'acp_yes'],
            ['name' => 'delete_any_user'],
            ['name' => 'delete_users_except_super_admin'],
            ['name' => 'invite_and_delete_other_client_users_client_restricted_users'],
            ['name' => 'no_user_management'],
            ['name' => 'invite_and_delete_other_owner_users_owner_restricted_users'],
            ['name' => 'invite_and_delete_other_users_restricted_users_abcn_personnel'],
        );
        //DB::table('permissions')->truncate();
        DB::table('permissions')->insert($permissions);
    }
}
