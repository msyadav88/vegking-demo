<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllVarietiesInBuyers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            if(!Schema::hasColumn('buyers','all_varieties'))
               $table->boolean('all_varieties')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('all_varieties');
        });
    }
}
