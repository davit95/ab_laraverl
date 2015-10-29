<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelPrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tel_prefixes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('country_code');
            $table->integer('prefix');
            $table->integer('logtime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tel_prefixes');
    }
}
