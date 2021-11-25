<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOfferPropertiesTable5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('offer_properties', function (Blueprint $table) {
            if (!Schema::hasColumn('offer_properties', 'additional_parameters')){
                $table->string('additional_parameters')->nullable();
            }
        });
        
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
