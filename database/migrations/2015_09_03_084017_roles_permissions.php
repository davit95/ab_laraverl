<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permissions', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->unsigned()->index();
            $table->bigInteger('permission_id')->unsigned()->index();
            /**
             * Table relations
             */
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles_permissions');
    }
}
