<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBaselinePriceFromSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if(Schema::hasColumn('settings','baseline_price')){
               $table->dropColumn('baseline_price');
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
        Schema::table('settings', function (Blueprint $table) {
            if(!Schema::hasColumn('settings','baseline_price')){
               $table->string('baseline_price')->nullable()->comment('average sale price used in pton');
            }
        });
    }
}
