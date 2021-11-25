<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAppHeadsAddBuyerfactorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_heads', function (Blueprint $table) {
            if (!Schema::hasColumn('app_heads', 'extra_supply_cost')){
                $table->float('extra_supply_cost', 8, 2)->nullable()->default(null);
            }
            if (!Schema::hasColumn('app_heads', 'extra_cost_to_buyer_factor')){
                $table->float('extra_cost_to_buyer_factor', 8, 2)->nullable()->default(null);
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
        Schema::table('app_heads', function (Blueprint $table) {
            //
        });
    }
}
