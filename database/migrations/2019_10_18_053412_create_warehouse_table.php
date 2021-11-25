<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stock_id')->unsigned()->index();
            $table->bigInteger('sale_id')->unsigned()->index();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('tons')->nullable();
            $table->string('product')->nullable();
            $table->date('dateStored')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('warehouse');
    }
}
