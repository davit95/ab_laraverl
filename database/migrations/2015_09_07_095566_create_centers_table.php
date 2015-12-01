<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->bigInteger('owner_id')->nullable()->unsigned()->index();
            $table->string('city_name');
            $table->bigInteger('city_id')->nullable()->unsigned()->index();
            $table->string('country');
            $table->bigInteger('country_id')->nullable()->unsigned()->index();
            $table->string('us_state');
            $table->bigInteger('us_state_id')->nullable()->unsigned()->index();
            $table->bigInteger('region_id')->nullable()->unsigned()->index();
            $table->string('company_name');
            $table->string('building_name');
            $table->string('address1');
            $table->string('address2');        
            $table->string('postal_code');
            $table->text('summary');
            $table->text('location');
            $table->text('amenities');
            $table->datetime('review_date');
            $table->text('review_comments');
            $table->enum('active_flag', ['Y', 'N', 'D', 'B', 'P'])->nullable();
            $table->text('notes');
            $table->string('virtual_tour_url');
            $table->string('map_url');
            $table->datetime('status_changed_at');
            $table->timestamps();
            /**
             * Table relations
             */
            $table->foreign('owner_id')->references('id')->on('owners')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('us_state_id')->references('id')->on('us_states')->onUpdate('restrict')->onDelete('set null');
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('centers');
    }
}
