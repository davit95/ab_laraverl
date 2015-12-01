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
            $table->bigIncrements('id');
            $table->bigInteger('center_price_id')->unsigned()->index();
            $table->bigInteger('currency_id')->unsigned()->index();
            $table->float('price');
            $table->float('with_live_receptionist_pack_price');
            $table->float('with_live_receptionist_full_price');
            /**
             * Table relations
             */
            $table->foreign('center_price_id')->references('id')->on('center_prices')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('restrict')->onDelete('cascade');

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
