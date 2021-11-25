<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarriercontactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriercontact', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('carrierid');
			$table->string('type');
			$table->string('transportname');
			$table->string('transportemail');
			$table->string('phone');
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
        Schema::dropIfExists('carriercontact');
    }
}
