<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteTransportationCostEstimateFromBuyers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            if (Schema::hasColumn('buyers', 'transportation_cost_estimate'))
              $table->dropColumn('transportation_cost_estimate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->string('transportation_cost_estimate');
        });
    }
}
