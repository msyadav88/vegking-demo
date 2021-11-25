<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('variety')->nullable();
            $table->string('size_range')->nullable();
            $table->string('packing')->nullable();
            $table->string('quantity')->nullable();
            $table->string('flesh_color')->nullable();
            $table->string('location_range')->nullable();
            $table->string('price_range')->nullable();
            $table->enum('status', array('listed', 'status'))->default('listed');
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
        Schema::dropIfExists('orders');
    }
}
