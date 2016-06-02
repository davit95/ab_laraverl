<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('center_sites', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('site_id')->unsigned()->index();
            $table->bigInteger('center_id')->unsigned()->index();
            /**
             * Table relations
             */
            $table->foreign('site_id')->references('id')->on('sites')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('center_sites');
    }
}
