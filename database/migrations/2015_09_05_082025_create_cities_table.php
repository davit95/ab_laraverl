<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('country_id')->unsigned()->index();
            $table->string('country_code');
            $table->bigInteger('us_state_id')->nullable()->unsigned()->index();
            $table->string('us_state_code')->nullable();
            $table->string('us_state')->nullable();
            $table->text('description');
            $table->text('buisness_info');
            $table->text('general_info');
            $table->boolean('active')->default(0);
            /**
             * Table relations
             */
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('us_state_id')->references('id')->on('us_states')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cities');
    }
}
