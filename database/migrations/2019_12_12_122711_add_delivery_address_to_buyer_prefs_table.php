<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryAddressToBuyerPrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_prefs', function (Blueprint $table) {
            if(!Schema::hasColumn('buyer_prefs','street')){
               $table->text('street')->nullable();
            }
            if(!Schema::hasColumn('buyer_prefs','city')){
               $table->string('city')->nullable();
            }
            if(!Schema::hasColumn('buyer_prefs','country')){
               $table->string('country')->nullable();
            }
            if(!Schema::hasColumn('buyer_prefs','postalcode')){
               $table->string('postalcode')->nullable();
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
            if(Schema::hasColumn('buyer_prefs','street')){
               $table->dropColumn('street');
            }
            if(Schema::hasColumn('buyer_prefs','city')){
               $table->dropColumn('city');
            }
            if(Schema::hasColumn('buyer_prefs','country')){
               $table->dropColumn('country');
            }
            if(Schema::hasColumn('buyer_prefs','postalcode')){
               $table->dropColumn('postalcode');
            }
        });
    }
}
