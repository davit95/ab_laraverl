<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhiteSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('white_sites', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->boolean('virtual_offices_offers')->default(false);
            $table->boolean('meeting_rooms_offers')->default(false);
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_home_url')->nullable();
            $table->string('url')->nullable();
            $table->enum('landing_page', ['steps_page', 'search_page'])->nullable();
            $table->longText('removed_centers_ids')->nullable();
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
        Schema::drop('white_sites');
    }
}
