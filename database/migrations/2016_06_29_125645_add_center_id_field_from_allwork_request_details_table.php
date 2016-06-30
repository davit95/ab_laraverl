<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCenterIdFieldFromAllworkRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allwork_request_details', function(Blueprint $table)
        {
            $table->integer('center_id')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allwork_request_details', function(Blueprint $table)
        {
            $table->dropColumn('center_id');
        });
    }
}
