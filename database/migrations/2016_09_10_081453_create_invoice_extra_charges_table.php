<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceExtraChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_extra_charges', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id');
            $table->string('service');
            $table->string('service_other');
            $table->integer('amount');
            $table->integer('period');
            $table->integer('step');
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
        Schema::drop('invoice_extra_charges');
    }
}
