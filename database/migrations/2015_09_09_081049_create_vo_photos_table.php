<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vo_photos', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('photo_id')->unsigned()->index();
            $table->bigInteger('center_id')->unsigned()->index();
            /**
             * Table relations
             */
            $table->foreign('photo_id')->references('id')->on('photos')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::drop('vo_photos');
    }
}
