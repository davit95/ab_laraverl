<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCenterIdsFieldFromAllworkRequestDetailsTable extends Migration
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
            $table->dropColumn('center_ids');
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
            $table->string('center_ids')->after('title');
        });
    }
}
