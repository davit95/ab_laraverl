<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonthlyPeriodFieldIntoTempCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_cart_items', function(Blueprint $table)
        {            
            $table->integer('monthly_period')->after('phone_number_selected')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_cart_items', function(Blueprint $table)
        {            
            $table->dropColumn('monthly_period');
        });
    }
}
