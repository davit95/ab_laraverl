<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('company_name');
            $table->string('phone');
            $table->string('address1');
            $table->string('address2');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->integer('postal_code')->nullable()->unsigned();
            $table->string('password');
            $table->string('card_name');
            $table->integer('card_number')->nullable()->unsigned();
            $table->integer('card_month')->nullable()->unsigned();
            $table->integer('card_year')->nullable()->unsigned();
            $table->integer('cvv2_number')->nullable()->unsigned();
            $table->string('status');
            $table->string('fax');
            $table->string('hint_answer');
            $table->integer('dv_user_key')->nullable();
            $table->integer('dv_phone_number')->nullable();
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
        Schema::drop('customers');
    }
}
