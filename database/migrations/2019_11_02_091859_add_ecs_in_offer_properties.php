<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEcsInOfferProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_properties', function (Blueprint $table) {
            if(!Schema::hasColumn('offer_properties','ecs')){
               $table->string('ecs')->nullable();
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
            if(Schema::hasColumn('offer_property','ecs')){
               $table->dropColumn('ecs');
            }
        });
    }
}
