<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTempCartItemsTable extends Migration
{
    public function up()
   {
       Schema::table('temp_cart_items', function (Blueprint $table) {
           $table->bigInteger('user_id')->after('id');
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::table('temp_cart_items', function (Blueprint $table) {
           $table->dropColumn('user_id');
       });    
   }
}
