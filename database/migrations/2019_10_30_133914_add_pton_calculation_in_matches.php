<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPtonCalculationInMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            if(!Schema::hasColumn('matches','pton_calculation')){
               $table->text('pton_calculation')->nullable()->after('profit_per_ton');
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
            if(Schema::hasColumn('matches','pton_calculation')){
               $table->dropColumn('pton_calculation');
            }
        });
    }
}
