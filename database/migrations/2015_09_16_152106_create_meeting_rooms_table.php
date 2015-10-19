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
            $table->increments('id');
            $table->integer('center_id');
            $table->string('name');
            $table->string('capacity');
            $table->string('hourly_rate');
            $table->string('half_day_rate');
            $table->string('full_day_rate');
            $table->string('min_hours_req');
            $table->integer('floor');
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
