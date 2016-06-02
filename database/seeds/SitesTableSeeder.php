<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = array(
            ['name' => 'avo'],
            ['name' => 'abcn'],
            ['name' => 'allwork'],
            ['name' => 'your_city_office'],
            ['name' => 'same_day_virtual'],
            ['name' => 'flexado'],
        );
        //DB::table('permissions')->truncate();
        DB::table('sites')->insert($sites);
    }
}
