<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuyerProductPrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_product_prefs', function (Blueprint $table) {
            
            if (!Schema::hasColumn('buyer_product_prefs', 'buyer_pref_id')){
                $table->bigInteger('buyer_pref_id')->nullable();
            }
            if (!Schema::hasColumn('buyer_product_prefs', 'key')){
                $table->bigInteger('key')->nullable();
            }
            if (!Schema::hasColumn('buyer_product_prefs', 'value')){
                $table->string('value')->nullable();
            }
            if (!Schema::hasColumn('buyer_product_prefs', 'premium')){
                $table->bigInteger('premium')->nullable();
            }
            if (Schema::hasColumn('buyer_product_prefs', 'product_id')){
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('buyer_product_prefs', 'buyer_id')){
                $table->dropColumn('buyer_id');
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
        Schema::table('buyer_product_prefs', function (Blueprint $table) {
            //
        });
    }
}
