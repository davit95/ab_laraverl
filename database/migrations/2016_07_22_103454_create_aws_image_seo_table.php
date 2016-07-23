<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwsImageSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aws_image_seo', function(Blueprint $table)
        {            
            $table->bigIncrements('id');
            $table->bigInteger('center_id');
            $table->string('image_name');
            $table->string('description');
            $table->string('alt');
            $table->string('caption');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aws_image_seo');
    }
}
