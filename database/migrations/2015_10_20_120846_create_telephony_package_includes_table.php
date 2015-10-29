<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelephonyPackageIncludesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('telephony_package_includes', function(Blueprint $table)
      {
          $table->increments('id');
          $table->integer('center_id');
          $table->integer('package_id');
          $table->string('include');
          $table->integer('place');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('telephony_package_includes');
    }
}
