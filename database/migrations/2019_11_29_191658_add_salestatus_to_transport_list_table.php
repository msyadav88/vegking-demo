<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalestatusToTransportListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transport_list', function (Blueprint $table) {
            if (!Schema::hasColumn('transport_list', 'salestatus'))
                $table->string('salestatus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transport_list', function (Blueprint $table) {
            //
        });
    }
}
