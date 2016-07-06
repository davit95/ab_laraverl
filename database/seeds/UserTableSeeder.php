<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (null == $user = User::where('email','super@admin.com')->first()) {
            $user = [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'role_id' => 1,
                'email' => 'super@admin.com',
                'username' => 'superadmin',
                'password' => bcrypt('admin'),
            ];
            DB::table('users')->insert($user);
        }
        if (null == $user = User::where('email','owner@admin.com')->first()) {
            $user = [
                'first_name' => 'Operator',
                'last_name' => 'user',
                'role_id' => 5,
                'email' => 'owner@admin.com',
                'username' => 'owner',
                'password' => bcrypt('owner'),
            ];
            DB::table('users')->insert($user);
        }
        if (null == $user = User::where('email','csr@admin.com')->first()) {
            $user = [
                'first_name' => 'Client',
                'last_name' => 'User',
                'role_id' => 3,
                'email' => 'csr@admin.com',
                'username' => 'csruser',
                'password' => bcrypt('asdasdasdd'),
            ];
            DB::table('users')->insert($user);
        }
        if (null == $user = User::where('email','admin-user@mail.ru')->first()) {
            $user = [
                'first_name' => 'Alliance',
                'last_name' => 'User',
                'role_id' => 10,
                'email' => 'admin-user@mail.ru',
                'username' => 'aliancecsruser',
                'password' => bcrypt('admin'),
            ];
            DB::table('users')->insert($user);
        }
    }
}
