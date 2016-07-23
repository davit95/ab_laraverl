<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullAccessColumnIntoApiServerAccessTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api_server_access_tokens', function(Blueprint $table)
        {
            $table->boolean('full_access')->after('api_key_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_server_access_tokens', function(Blueprint $table)
        {
            $table->dropColumn('full_access');
        });
    }
}
