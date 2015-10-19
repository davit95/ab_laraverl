<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('fax');
            $table->string('url');
            $table->string('email');
            $table->string('address1');
            $table->string('address2');
            $table->integer('city_id');
            $table->integer('region_id');
            $table->integer('us_state_id')->nullable();
            $table->integer('country_id');
            $table->string('postal_code');
            $table->text('notes');
            $table->string('company_name');
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
        Schema::drop('owners');
    }
}
