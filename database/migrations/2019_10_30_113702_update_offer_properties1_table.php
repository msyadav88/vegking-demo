<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOfferProperties1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_properties', function (Blueprint $table) {
            if( !Schema::hasColumn('offer_properties','value') ){
                $table->string("value")->nullable();
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
        Schema::table('offer_properties', function (Blueprint $table) {
            //
        });
    }
}
