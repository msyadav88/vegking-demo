<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            if (!Schema::hasColumn('offers', 'available_per_day'))
              $table->integer('available_per_day')->nullable();          
            if (!Schema::hasColumn('offers', 'available_from_date'))
              $table->date('available_from_date')->nullable();
            if (!Schema::hasColumn('offers', 'purpose'))
              $table->integer('purpose')->nullable();
            if (!Schema::hasColumn('offers', 'defects'))
              $table->integer('defects')->nullable();
            if (!Schema::hasColumn('offers', 'pallets_available'))
              $table->integer('pallets_available')->nullable();
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
