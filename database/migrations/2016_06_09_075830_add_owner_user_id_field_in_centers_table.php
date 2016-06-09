<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerUserIdFieldInCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('centers', function (Blueprint $table) {
            $table->bigInteger('owner_user_id')->after('owner_id')->nullable()->unsigned()->index();
            /**
             * Table relations
             */
            $table->foreign('owner_user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centers', function (Blueprint $table) {
            $table->dropForeign('centers_owner_user_id_foreign');
            $table->dropColumn('owner_user_id');
        });    
    }
}
