<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->index();
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->string('product_id')->nullable();
            $table->string('seller_id')->nullable();
            $table->string('buyer_id')->nullable();
            $table->enum('status', array('match', 'sale'))->default('match');
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
        Schema::dropIfExists('matchs');
    }
}
