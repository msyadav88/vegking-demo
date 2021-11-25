<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuyerPrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_prefs', function (Blueprint $table) {
            if (!Schema::hasColumn('buyer_prefs', 'buyer_product_pref_id')){
                $table->bigInteger('buyer_product_pref_id')->nullable();
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
        Schema::table('buyer_prefs', function (Blueprint $table) {
            //
        });
    }
}
