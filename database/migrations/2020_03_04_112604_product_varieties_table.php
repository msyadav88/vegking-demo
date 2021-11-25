<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_varieties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->text('URL')->nullable();
            $table->text('higher_taxon')->nullable();
            $table->text('genus')->nullable();
            $table->text('species')->nullable();
            $table->text('parentage')->nullable();
            $table->text('breeder')->nullable();
            $table->text('breeder_agent')->nullable();
            $table->enum('status', array('0', '1'))->default('1');
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
        Schema::dropIfExists('product_varieties');
    }
}
