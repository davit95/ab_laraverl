<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('payment_type');
            $table->integer('item_id');
            $table->double('price');
            $table->boolean('is_recurring')->default(false);
            $table->integer('recurring_period_within_month')->nullable();
            $table->integer('recurring_attempts')->nullable();
            $table->integer('customer_id');
            $table->string('status')->default('pending');
            $table->text('payment_response')->nullable();
            $table->text('serialized_card_item_info')->nullable();
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
        Schema::drop('invoices');
    }
}
