<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_files', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('file_type');
            $table->string('uploaded_by');
            $table->string('path');
            $table->string('file_category');
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
        Schema::drop('customers_files');
    }
}
