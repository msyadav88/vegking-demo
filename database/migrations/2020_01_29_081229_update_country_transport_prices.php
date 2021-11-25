<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountryTransportPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('country_transport_prices', function (Blueprint $table) {
            if (!Schema::hasColumn('country_transport_prices', 'region_id')) {
                $table->bigInteger('region_id')->nullable();
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
        Schema::table('country_transport_prices', function (Blueprint $table) {
            if(Schema::hasColumn('region_id')){
               $table->dropColumn('region_id');
            }
        });
    }
}
