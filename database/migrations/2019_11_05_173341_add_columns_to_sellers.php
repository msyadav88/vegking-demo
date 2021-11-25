<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSellers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
          if(!Schema::hasColumn('sellers','truck_loads_day')){
             $table->integer('truck_loads_day')->nullable()->after('note');
          }
          if(!Schema::hasColumn('sellers','truck_loads_week')){
             $table->integer('truck_loads_week')->nullable()->after('truck_loads_day');
          }
          if(!Schema::hasColumn('sellers','truck_loads_total')){
             $table->integer('truck_loads_total')->nullable()->after('truck_loads_week');
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
        Schema::table('sellers', function (Blueprint $table) {
            //
        });
    }
}
