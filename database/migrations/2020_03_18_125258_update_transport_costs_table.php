<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransportCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_costs', function (Blueprint $table) {
            if(Schema::hasColumn('transport_costs','country_id')){
               $table->dropColumn('country_id');
            }

            if(Schema::hasColumn('transport_costs', 'region_id')){
                $table->dropColumn('region_id');
            }

            if(!Schema::hasColumn('transport_costs','country')){
                $table->string('country')->nullable()->after('id');
            }
    
            if(!Schema::hasColumn('transport_costs', 'region')){
                $table->string('region')->nullable()->after('country');
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
        //
    }
}
