<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalesTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
                    //$table->dropColumn('delivery_date');
    //
        if (Schema::hasColumn('sales', 'delivery_date'))
        {
            Schema::table('sales', function (Blueprint $table) {
                $table->dropColumn('delivery_date');                   
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
