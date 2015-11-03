<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrPhotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_photos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('photo_id');
            $table->integer('center_id');
            $table->integer('mr_id');
            $table->boolean('primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mr_photos');
    }
}
