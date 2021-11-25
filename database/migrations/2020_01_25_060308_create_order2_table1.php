<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder2Table1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order2');
        Schema::create('order2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('buyer_id')->nullable();
            $table->string('stock_id')->nullable();
            $table->string('transport_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('message_id')->nullable();
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
