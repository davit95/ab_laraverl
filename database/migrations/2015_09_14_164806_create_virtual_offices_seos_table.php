<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualOfficesSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_offices_seos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('center_id');
            $table->text('sentence1');
            $table->text('sentence2');
            $table->text('sentence3');
            $table->text('avo_description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->string('h1');
            $table->string('h2');
            $table->string('h3');
            $table->text('seo_footer');
            $table->text('abcn_description');
            $table->text('abcn_title');
            $table->string('subhead');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('virtual_offices_seos');
    }
}
