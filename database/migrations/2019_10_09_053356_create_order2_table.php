<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->bigInteger('transport_id')->unsigned()->index();
            $table->bigInteger('payment_id')->unsigned()->index();
            $table->bigInteger('message_id')->unsigned()->index();
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
        Schema::dropIfExists('order2');
    }
}
