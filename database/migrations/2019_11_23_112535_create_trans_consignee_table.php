<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransConsigneeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_consignee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('loadid')->nullable();
            $table->string('consignee')->nullable();
            $table->string('consignee_address')->nullable();
            $table->string('consignee_reference')->nullable();
            $table->string('consignee_date')->nullable();
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
        Schema::dropIfExists('trans_consignee');
    }
}
