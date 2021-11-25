<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransShipperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_shipper', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('loadid')->nullable();
            $table->string('shipper')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('shipper_reference')->nullable();
            $table->string('shipper_date')->nullable();
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
        Schema::dropIfExists('trans_shipper');
    }
}
