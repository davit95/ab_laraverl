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
    }
}
