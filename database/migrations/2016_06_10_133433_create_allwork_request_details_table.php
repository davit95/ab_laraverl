<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllworkRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allwork_request_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('i_would_like_to');
            $table->string('title');
            $table->string('center_ids');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('email');
            $table->string('phone');
            $table->string('size');
            $table->string('start_date');
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('allwork_request_details');
    }
}
