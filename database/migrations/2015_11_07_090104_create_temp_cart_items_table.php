<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_cart_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('temp_user_id');
            $table->enum('type', ['mr', 'vo']);
            $table->integer('center_id');
            $table->integer('mr_id')->nullable();
            $table->date('mr_date')->nullable();
            $table->time('mr_start_time')->nullable();
            $table->time('mr_end_time')->nullable();
            $table->string('vo_plan')->nullable();
            $table->integer('price');
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
        Schema::drop('temp_cart_items');
    }
}
