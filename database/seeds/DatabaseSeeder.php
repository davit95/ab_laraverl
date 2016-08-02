<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(RolesTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        //$this->call(RolesPermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        // $this->call(CurrencyTableSeeder::class);
        // $this->call(SitesTableSeeder::class);
        // $this->call(StatesTableSeeder::class);

        Model::reguard(); 
    }
}
