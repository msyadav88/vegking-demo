<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'variety')){
                $table->dropColumn('variety');
            } 
            if (Schema::hasColumn('orders', 'packing')){
                $table->dropColumn('packing');
            } 
            if (Schema::hasColumn('orders', 'flesh_color')){
                $table->dropColumn('flesh_color');
            } 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
