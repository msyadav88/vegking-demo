<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAppHeadsTable5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('product', 'app_heads'))
        {
            Schema::table('app_heads', function (Blueprint $table) {
                $table->dropColumn('product');                   
            });
        }
        Schema::table('app_heads', function (Blueprint $table) {;
            if (!Schema::hasColumn('app_heads', 'product_id'))
                $table->integer('product_id')->nullable()->default(0);
            
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