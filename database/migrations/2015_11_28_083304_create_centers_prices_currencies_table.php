<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersPricesCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_price_currencies', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('center_price_id');
            $table->integer('currency_id');
            $table->float('price');
            $table->float('with_live_receptionist_pack_price');
            $table->float('with_live_receptionist_full_price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('center_price_currencies');
    }
}
