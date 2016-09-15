<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_balances', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('customer_id');
            $table->integer('amount');
            $table->string('type');
            $table->integer('number');
            $table->dateTime('receive_date');
            $table->text('notes');
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
        Schema::drop('customers_balances');
    }
}
