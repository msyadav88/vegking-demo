<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuyersTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            if (Schema::hasColumn('buyers', 'defects')){
                $table->dropColumn('defects');
            }
            if (Schema::hasColumn('buyers', 'flesh_color')){
                $table->dropColumn('flesh_color');
            }
            if (Schema::hasColumn('buyers', 'purposes')){
                $table->dropColumn('purposes');
            }
            if (Schema::hasColumn('buyers', 'packaging')){
                $table->dropColumn('packaging');
            }
            if (Schema::hasColumn('buyers', 'packing')){
                $table->dropColumn('packing');
            }
            if (Schema::hasColumn('buyers', 'variety')){
                $table->dropColumn('variety');
            }
            if (Schema::hasColumn('buyers', 'variety_premium')){
                $table->dropColumn('variety_premium');
            }
            if (Schema::hasColumn('buyers', 'product')){
                $table->dropColumn('product');
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
        Schema::table('buyers', function (Blueprint $table) {
            //
        });
    }
}
