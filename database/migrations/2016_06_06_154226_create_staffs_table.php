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
        Schema::create('staffs', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('title');
            $table->integer('phone_1');
            $table->integer('phone_2');
            $table->string('ext_1');
            $table->string('ext_2');
            $table->string('email')->unique();
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
        Schema::drop('staffs');
    }
}
