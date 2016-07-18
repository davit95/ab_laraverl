<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionIdAndUrlInUsersTable extends Migration
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
           $table->string('url')->after('company_name');
           $table->integer('region_id')->after('country_id');
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
           $table->dropColumn('url');
           $table->dropColumn('region_id');
       });
   }
}
