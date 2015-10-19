<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers_filters', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('center_id');
            $table->boolean('virtual_office');
            $table->boolean('office');
            $table->boolean('meeting_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('centers_filters');
    }
}
