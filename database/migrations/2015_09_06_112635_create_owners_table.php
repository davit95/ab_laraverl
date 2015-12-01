<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->string('fax');
            $table->string('url');
            $table->string('email')/*->unique()*/;
            $table->string('address1');
            $table->string('address2');
            $table->bigInteger('us_state_id')->nullable()->unsigned()->index();
            $table->bigInteger('region_id')->nullable()->unsigned()->index();
            $table->bigInteger('city_id')->nullable()->unsigned()->index();
            $table->bigInteger('country_id')->nullable()->unsigned()->index();
            $table->string('postal_code');
            $table->text('notes');
            $table->string('company_name');
            $table->timestamps();
            /**
             * Table relations
             */
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('us_state_id')->references('id')->on('us_states')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('owners');
    }
}
