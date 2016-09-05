<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnIntoAllworkRequestDetailsTable extends Migration
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
            $table->enum('status', ['not_contacted', 'touring_proposal', 'closed_won', 'lost', 'on_hold'])->nullable()->after('title');
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
            $table->dropColumn('status');
        });
    }
}
