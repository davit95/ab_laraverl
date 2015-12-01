<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_rooms', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('center_id')->unsigned()->index();
            $table->string('name');
            $table->string('capacity');
            $table->float('hourly_rate');
            $table->float('half_day_rate');
            $table->float('full_day_rate');
            $table->string('min_hours_req');
            $table->integer('floor');
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
        Schema::drop('meeting_rooms');
    }
}
