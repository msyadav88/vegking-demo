<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offersent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('match_id')->unsigned()->index();
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->time('time_sent');
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
        Schema::dropIfExists('offersent');
    }
}
