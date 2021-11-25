<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_trucks', function (Blueprint $table) {	
            $table->bigIncrements('id');
			$table->integer('sale_id');
			$table->float('price', 8, 2);	
			$table->date('sale_date')->nullable();
			$table->date('delivery_date')->nullable();
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
        Schema::table('sale_trucks', function (Blueprint $table) {
            //
        });
    }
}
