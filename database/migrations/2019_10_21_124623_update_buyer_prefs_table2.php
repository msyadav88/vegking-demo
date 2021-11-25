<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuyerPrefsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_prefs', function (Blueprint $table) {
            if (!Schema::hasColumn('buyer_prefs', 'product_id')){
                 $table->bigInteger('product_id')->nullable();
            }
            if (Schema::hasColumn('buyer_prefs', 'type')){
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('buyer_prefs', 'key')){
                $table->dropColumn('key');
            }
            if (Schema::hasColumn('buyer_prefs', 'val')){
                $table->dropColumn('val');
            }
            if (Schema::hasColumn('buyer_prefs', 'buyer_product_pref_id')){
                $table->dropColumn('buyer_product_pref_id');
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
