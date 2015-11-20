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
            $table->increments('id');
            $table->string('slug');
            $table->integer('owner_id');
            $table->string('city_name');
            $table->integer('city_id');
            $table->string('country');
            $table->integer('country_id');
            $table->string('us_state');
            $table->integer('us_state_id')->nullable();
            $table->integer('region_id');
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
