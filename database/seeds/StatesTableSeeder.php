<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = array(
            ['name' => 'New South Wales', 'code' => 'NSW', 'slug' => strtolower('New South Wales'), 'country' => 'australia'],
            ['name' => 'Victoria', 'code' => 'VIC', 'slug' => strtolower('Victoria'), 'country' => 'australia'],
            ['name' => 'Queensland', 'code' => 'QLD', 'slug' => strtolower('Queensland'), 'country' => 'australia'],
            ['name' => 'Tasmania', 'code' => 'TAS', 'slug' => strtolower('Tasmania'), 'country' => 'australia'],
            ['name' => 'South Australia', 'code' => 'SA', 'slug' => strtolower('South Australia'), 'country' => 'australia'],
            ['name' => 'Western Australia', 'code' => 'WA', 'slug' => strtolower('Western Australia'), 'country' => 'australia'],
            ['name' => 'Northern Territory', 'code' => 'NT', 'slug' => strtolower('Northern Territory'), 'country' => 'australia'],
            ['name' => 'Australian Capital Terrirory', 'code' => 'ACT', 'slug' => strtolower('Australian Capital Terrirory'), 'country' => 'australia'],
            ['name' => 'British Columbia', 'code' => 'BC', 'slug' => strtolower('British Columbia'), 'country' => 'canada'],
            ['name' => 'Ontario', 'code' => 'ON', 'slug' => strtolower('Ontario'), 'country' => 'canada'],
            ['name' => 'Newfoundland and Labrador', 'code' => 'NL', 'slug' => strtolower('Newfoundland and Labrador'), 'country' => 'canada'],
            ['name' => 'Nova Scotia', 'code' => 'NS', 'slug' => strtolower('Nova Scotia'), 'country' => 'canada'],
            ['name' => 'Prince Edward Island', 'code' => 'PE', 'slug' => strtolower('Prince Edward Island'), 'country' => 'canada'],
            ['name' => 'New Brunswick', 'code' => 'NB', 'slug' => strtolower('New Brunswick'), 'country' => 'canada'],
            ['name' => 'Quebec', 'code' => 'QC', 'slug' => strtolower('Quebec'), 'country' => 'canada'],
            ['name' => 'Manitoba', 'code' => 'MB', 'slug' => strtolower('Manitoba'), 'country' => 'canada'],
            ['name' => 'Saskatchewan', 'code' => 'SK', 'slug' => strtolower('Saskatchewan'), 'country' => 'canada'],
            ['name' => 'Alberta', 'code' => 'AB', 'slug' => strtolower('Alberta'), 'country' => 'canada'],
            ['name' => 'Northwest Territories', 'code' => 'NT', 'slug' => strtolower('Northwest Territories'), 'country' => 'canada'],
            ['name' => 'Nunavut', 'code' => 'NU', 'slug' => strtolower('Nunavut'), 'country' => 'canada'],
            ['name' => 'Yukon Territory', 'code' => 'YT', 'slug' => strtolower('Yukon Territory'), 'country' => 'canada'],
        );
        //DB::table('permissions')->truncate();
        DB::table('states')->insert($states);
    }
}