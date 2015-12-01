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
            $table->bigIncrements('id');
            $table->bigInteger('center_id')->unsigned()->index();
            $table->boolean('virtual_office');
            $table->boolean('meeting_room');
            $table->boolean('office');
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
        Schema::drop('centers_filters');
    }
}
