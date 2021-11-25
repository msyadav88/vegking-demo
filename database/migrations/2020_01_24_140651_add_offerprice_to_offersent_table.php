<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfferpriceToOffersentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offersent', function (Blueprint $table) {
            if(!Schema::hasColumn('offersent','offerprice')){
               $table->float('offerprice')->nullable();;
            };
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offersent', function (Blueprint $table) {
            if(Schema::hasColumn('offersent','offerprice')){
               $table->dropColumn('offerprice');
            }
        });
    }
}
