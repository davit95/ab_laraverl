<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationSEOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_SEO', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('City',250);
            $table->string('State',250);
            $table->string('Country',2);
            $table->string('Title',250);
            $table->string('H1',250);
            $table->string('H2',250);
            $table->enum('Type',['continent_category','country_category','state_category','city_category','continent_pricing_grid','country_pricing_grid','state_pricing_grid','city_pricing_grid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('location_SEO');
    }
}
