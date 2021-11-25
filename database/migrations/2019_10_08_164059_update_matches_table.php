<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('matchs', function (Blueprint $table) {
          if (Schema::hasColumn('matchs', 'order_id'))
            $table->dropColumn('order_id');
          if (!Schema::hasColumn('matchs', 'stock_id'))
            $table->bigInteger('stock_id')->nullable();
          if (!Schema::hasColumn('matchs', 'profit_per_truck'))
            $table->string('profit_per_truck')->nullable();
          if (!Schema::hasColumn('matchs', 'profit_per_ton'))
            $table->string('profit_per_ton')->nullable();
          if (!Schema::hasColumn('matchs', 'total_profit'))
            $table->string('total_profit')->nullable();
          if (!Schema::hasColumn('matchs', 'status'))
            $table->enum('status', array('match', 'sale'))->default('match');
      });
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
