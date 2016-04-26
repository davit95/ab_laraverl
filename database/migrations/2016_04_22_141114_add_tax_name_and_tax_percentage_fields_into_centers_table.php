<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxNameAndTaxPercentageFieldsIntoCentersTable extends Migration
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
            $table->string('tax_name')->after('email_flag');
            $table->string('tax_percentage')->after('tax_name');
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
            $table->dropColumn('tax_name');
            $table->dropColumn('tax_percentage');
        });
    }
}
