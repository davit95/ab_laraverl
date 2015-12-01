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
            $table->bigIncrements('id');
            $table->bigInteger('center_id')->unsigned()->index();
            $table->float('lat', 10,6);
            $table->float('lng', 10,6);
            /**
             * Table relations
             */
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('restrict')->onDelete('cascade');
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
