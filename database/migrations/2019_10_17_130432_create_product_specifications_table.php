<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->string('field');
            $table->string('display_name');
            $table->integer('importance')->nullable();
            $table->integer('order')->nullable();
            $table->enum('hasmany', array('Yes', 'No'))->default('No');
            $table->enum('required', array('Yes', 'No'))->default('Yes');
            $table->string('default')->nullable();
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
        Schema::dropIfExists('product_specifications');
    }
}
