<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->nullable()->unsigned()->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name');
            $table->string('email')/*->unique()*/->nullable();
            $table->string('username')/*->unique()*/->nullable();
            $table->string('phone');
            $table->string('passwrod_hint');
            $table->string('address1');
            $table->string('address2');
            $table->integer('city_id')->nullable()->unsigned()->index();
            $table->integer('us_state_id')->nullable()->unsigned()->index();
            $table->string('postal_code');
            $table->integer('country_id')->nullable()->unsigned()->index();
            $table->string('password')->nullable();
            $table->string('cc_name');
            $table->string('cc_number');
            $table->string('cc_year');
            $table->string('cc_month');
            $table->string('cvv2');
            $table->integer('status');
            $table->string('fax');
            $table->string('hint_answer');
            $table->string('dv_user_key');
            $table->string('dv_phone_number');
            $table->rememberToken();
            $table->timestamps();

            //$table->foreign('role_id')->references('id')->on('roles')->onUpdate('restrict')->onDelete('set null');
            //$table->foreign('city_id')->references('id')->on('cities')->onUpdate('restrict')->onDelete('set null');
            //$table->foreign('us_state_id')->references('id')->on('us_states')->onUpdate('restrict')->onDelete('set null');
            //$table->foreign('country_id')->references('id')->on('countries')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
