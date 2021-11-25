<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->string('profit_per_ton')->nullable();
            $table->string('profit_per_truck')->nullable();
            $table->string('total_profit')->nullable();
            $table->integer('numofmismatches')->nullable();
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
        Schema::dropIfExists('matches');
    }
}
