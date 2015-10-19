<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tel_countries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('country_code');
            $table->string('full_name');
            $table->string('abbrv');
            $table->integer('logtime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tel_countries');
    }
}
