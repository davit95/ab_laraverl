<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingRoomsOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_rooms_options', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('meeting_room_id')->unsigned()->index();
            $table->text('room_description');
            $table->string('parking_rate');
            $table->text('parking_description');
            $table->string('network_rate');
            $table->string('wireless_rate');
            $table->string('phone_rate');
            $table->string('admin_services_rate');
            $table->string('whiteboard_rate');
            $table->string('tvdvdplayer_rate');
            $table->string('projector_rate');
            $table->string('videoconferencing_rate');
            $table->text('video_equipment');
            $table->string('bridge_connection_available');
            $table->string('catering');
            $table->string('credit_cards');
            /**
             * Table relations
             */
            $table->foreign('meeting_room_id')->references('id')->on('meeting_rooms')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meeting_rooms_options');
    }
}
