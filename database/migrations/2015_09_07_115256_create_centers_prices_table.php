<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_prices', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('center_id')->unsigned()->index();
            $table->bigInteger('package_id')->unsigned()->index();
            $table->float('price');
            $table->float('with_live_receptionist_pack_price');
            $table->float('with_live_receptionist_full_price');
            $table->timestamps();
            /**
             * Table relations
             */
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('center_prices');
    }
}
