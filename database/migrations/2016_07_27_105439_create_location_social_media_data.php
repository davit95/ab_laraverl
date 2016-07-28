<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationSocialMediaData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_social_media_data', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('center_id');
            $table->string('youtube_url');
            $table->string('location_url');
            $table->string('facebook_url');
            $table->string('twitter_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('location_social_media_data');
    }


}
