<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllworkCenterActiveFlagInCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('centers', function(Blueprint $table)
        {
            $table->enum('allwork_active_flag', ['Y', 'N', 'D', 'B', 'P'])->nullable()->after('active_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centers', function(Blueprint $table)
        {
            $table->dropColumn('allwork_active_flag');
        });
    }
}
