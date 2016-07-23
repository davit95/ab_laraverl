<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullAccessColumnIntoApiServerKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_server_keys', function(Blueprint $table)
        {
            $table->boolean('full_access')->after('origin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_server_keys', function(Blueprint $table)
        {
            $table->dropColumn('full_access');
        });
    }
}
