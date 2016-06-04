<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCenterInfoFieldsInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->integer('center_id')->after('company_name');
            $table->integer('live_receptionist')->after('center_id');
            $table->integer('package_option')->after('live_receptionist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function(Blueprint $table)
        {            
            $table->dropColumn('center_id');
            $table->dropColumn('live_receptionist');
            $table->dropColumn('package_option');
        });
    }
}
