<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOfferTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            if (Schema::hasColumn('offers', 'variety')){
                $table->dropColumn('variety');
            } 
            if (Schema::hasColumn('offers', 'flesh_color')){
                $table->dropColumn('flesh_color');
            } 
            if (Schema::hasColumn('offers', 'purposes')){
                $table->dropColumn('purposes');
            }
            if (Schema::hasColumn('offers', 'defects')){
                $table->dropColumn('defects');
            } 
            if (Schema::hasColumn('offers', 'packaging')){
                $table->dropColumn('packaging');
            }  
            if (Schema::hasColumn('offers', 'soil')){
                $table->dropColumn('soil');
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
        Schema::table('offers', function (Blueprint $table) {
            //
        });
    }
}
