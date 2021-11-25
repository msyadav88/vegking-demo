<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('variety')->nullable();
            $table->string('size_from')->nullable();
            $table->string('size_to')->nullable();
            $table->string('packing')->nullable();
            $table->string('quantity')->nullable();
            $table->string('flesh_color')->nullable();
            $table->string('location_from')->nullable();
            $table->string('location_to')->nullable();
            $table->float('price_from')->nullable();
            $table->float('price_to')->nullable();
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
        Schema::dropIfExists('offer_requests');
    }
}
