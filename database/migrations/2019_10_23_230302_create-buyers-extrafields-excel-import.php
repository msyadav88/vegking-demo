<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersExtrafieldsExcelImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            if( !Schema::hasColumn('buyers','extra_transport_cost_per_ton') )
                $table->string("extra_transport_cost_per_ton")->nullable();
            if( Schema::hasColumn('buyers','username') )
                $table->unique('username')->default('-');
            if( Schema::hasColumn('buyers','email') )
                $table->unique('email')->default('-');
            if( Schema::hasColumn('buyers','phone') )
                $table->unique('phone')->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer', function (Blueprint $table) {
            //
        });
    }
}
