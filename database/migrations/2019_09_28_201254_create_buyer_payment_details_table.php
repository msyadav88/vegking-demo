<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('buyer_id');
            $table->integer('payment_type')->nullable();
            $table->integer('payment_terms')->nullable();
            $table->integer('currency')->nullable();
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
        Schema::dropIfExists('buyer_payment_details');
    }
}
