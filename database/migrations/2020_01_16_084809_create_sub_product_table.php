<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->nullable();
            $table->string('sub_pro_name_en')->nullable();
            $table->string('sub_pro_name_pl')->nullable();
            $table->string('sub_pro_name_de')->nullable();
            $table->string('image',191)->nullable();
            $table->date('date_added')->nullable();
            $table->date('date_updated')->nullable();
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
        Schema::dropIfExists('sub_product');
    }
}
