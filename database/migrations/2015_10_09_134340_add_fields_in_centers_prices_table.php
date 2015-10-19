<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInCentersPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('centers_prices', function(Blueprint $table)
        {
            $table->integer('with_live_receptionist_pack_price')->after('price');
            $table->integer('with_live_receptionist_full_price')->after('price');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centers_prices', function(Blueprint $table)
        {
            $table->dropColumn(['with_live_receptionist_pack_price', 'with_live_receptionist_full_price']);
        });
    }
}
