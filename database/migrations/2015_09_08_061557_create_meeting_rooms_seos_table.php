<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingRoomsSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_rooms_seos', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('center_id')->unsigned()->index();
            $table->text('sentence1');
            $table->text('sentence2');
            $table->text('sentence3');
            $table->text('avo_description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->string('h1');
            $table->string('h2');
            $table->string('h3');
            $table->text('seo_footer');
            $table->text('abcn_description');
            $table->text('abcn_title');
            $table->string('subhead');
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
        Schema::drop('meeting_rooms_seos');
    }
}
