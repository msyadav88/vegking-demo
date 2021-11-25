<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchestempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchestemp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->index();
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('seller_id')->unsigned()->index();
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->enum('status', array('sent', 'opened','clicked','contacted','sold','delivered'))->nullable();
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
        Schema::dropIfExists('matchestemp');
    }
}
