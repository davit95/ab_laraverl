<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerIdFieldFromAllworkRequestDetailsTable extends Migration
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
            $table->integer('owner_id')->after('center_id');
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
            $table->dropColumn('owner_id');
        });
    }
}
