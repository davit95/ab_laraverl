<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterSpaceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_space_types', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('center_id');
            $table->string('type');
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('center_space_types');
    }
}
