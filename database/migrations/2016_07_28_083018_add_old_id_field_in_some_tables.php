<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOldIdFieldInSomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->integer('old_id')->unique()->nullable()->after('id');
            $table->integer('old_owner_id')->unique()->nullable()->after('old_id');
        });
        Schema::table('users_files', function(Blueprint $table)
        {
            $table->integer('old_id')->unique()->nullable()->after('id');
        });
        Schema::table('owners', function(Blueprint $table)
        {
            $table->integer('old_id')->unique()->nullable()->after('id');
        });
        Schema::table('centers', function(Blueprint $table)
        {
            $table->integer('old_id')->unique()->nullable()->after('id');
        });
        Schema::table('customers', function(Blueprint $table)
        {
            $table->integer('old_id')->unique()->nullable()->after('id');
        });
        Schema::table('invoices', function(Blueprint $table)
        {
            $table->integer('old_id')->unique()->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('users_old_id_unique');
        });
        Schema::table('users_files', function(Blueprint $table)
        {
            $table->dropColumn('users_files_old_id_unique');
        });
        Schema::table('owners', function(Blueprint $table)
        {
            $table->dropColumn('owners_old_id_unique');
        });
        Schema::table('centers', function(Blueprint $table)
        {
            $table->dropColumn('centers_old_id_unique');
        });
        Schema::table('customers', function(Blueprint $table)
        {
            $table->dropColumn('customers_old_id_unique');
        });
        Schema::table('invoices', function(Blueprint $table)
        {
            $table->dropColumn('invoices_old_id_unique');
        });
    }
}