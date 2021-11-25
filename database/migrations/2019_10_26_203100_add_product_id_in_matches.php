<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdInMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            if(!Schema::hasColumn('matches','product_id')){
               $table->integer('product_id')->nullable()->after('stock_id');
            }
            if(Schema::hasColumn('matches','buyer_id')){
               $table->renameColumn('buyer_id','buyer_pref_id');
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
        Schema::table('matches', function (Blueprint $table) {
            if(Schema::hasColumn('matches','product_id')){
               $table->dropColumn('product_id');
            }
            if(Schema::hasColumn('matches','buyer_pref_id')){
               $table->renameColumn('buyer_pref_id','buyer_id');
            }
        });
    }
}
