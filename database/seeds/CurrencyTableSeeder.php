<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = array(
            ['name' => 'USD', 'symbol' => '$', 'image' => 'usd.png'],
            ['name' => 'EUR', 'symbol' => '€', 'image' => 'eur.png'],
            ['name' => 'GBP', 'symbol' => '£', 'image' => 'gbp.png'],
            ['name' => 'AUD', 'symbol' => '$', 'image' => 'aud.png']
        );
        DB::table('currencies')->truncate();
        DB::table('currencies')->insert($currencies);
    }
}
