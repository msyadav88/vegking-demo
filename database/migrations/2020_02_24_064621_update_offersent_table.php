<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOffersentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offersent', function (Blueprint $table) {
            if (!Schema::hasColumn('offersent', 'order_id'))
              $table->integer('order_id')->nullable()->after('buyer_id');
           
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
            if(Schema::hasColumn('offersent','order_id')){
               $table->dropColumn('order_id');
            }
        });
    }
}
