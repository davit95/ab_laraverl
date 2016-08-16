<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterProgramPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_program_partners', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('center_id');
            $table->string('program_name');
            $table->string('program_badge_url');

            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('center_program_partners');
    }
}
