<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers_coordinates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('center_id');
            $table->float('lat', 10,6);
            $table->float('lng', 10,6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('centers_coordinates');
    }
}
