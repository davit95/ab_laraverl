<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_features', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('center_id');
            $table->bigInteger('feature_id');
            $table->string('details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('center_features');
    }
}
