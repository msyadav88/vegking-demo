<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seller_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('variety')->nullable();
            $table->string('size_from')->nullable();
            $table->string('size_to')->nullable();
            $table->string('packing')->nullable();
            $table->string('quantity')->nullable();
            $table->string('flesh_color')->nullable();
            $table->string('location')->nullable();
            $table->float('price')->nullable();
            $table->enum('status', array('New', 'Pending', 'Processing', 'Declined', 'Sale'))->default('New');
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
        Schema::dropIfExists('offers');
    }
}