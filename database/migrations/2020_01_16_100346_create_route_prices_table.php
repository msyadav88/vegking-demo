<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('kms')->nullable();
            $table->string('price')->nullable();
            $table->string('to_region_id')->nullable();
            $table->string('from_region_id')->nullable();
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
        Schema::dropIfExists('route_prices');
    }
}
