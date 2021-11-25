<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOffersTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            if (!Schema::hasColumn('offers', 'stock_status')){
                $table->enum('stock_status', array('unavailable', 'available','upcoming_stock'))->nullable()->default(null);
            }
            if (!Schema::hasColumn('offers', 'load_status')){
                $table->enum('load_status', array('ready_for_collection', 'unplanned','planned','loaded','unloaded','in_store','rejected','other'))->nullable()->default(null);
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
        Schema::table('offers', function (Blueprint $table) {
            //
        });
    }
}
