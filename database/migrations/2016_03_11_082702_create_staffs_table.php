<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('owner_id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('title');
                $table->string('email')->nullable();
                $table->integer('phone_1');
                $table->integer('phone_2');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staffs');
    }
}
