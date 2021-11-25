<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffers2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('match_id');
            $table->bigInteger('pref_id');
            $table->bigInteger('stock_id');
            $table->float('avgsaleprice')->nullable();
            $table->float('saleprice')->nullable();
            $table->float('offerprice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers2');
    }
}
