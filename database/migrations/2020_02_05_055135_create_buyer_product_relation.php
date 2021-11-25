<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerProductRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_product_relation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('name');
            $table->string('name_pl');
            $table->string('name_de');
            $table->string('image')->nullable();
            $table->text('product_configuration')->nullable();
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
        Schema::dropIfExists('buyer_product_relation');
    }
}
