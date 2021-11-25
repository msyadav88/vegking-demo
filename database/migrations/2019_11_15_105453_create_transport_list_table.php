<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_list', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('salesid')->unsigned()->index();
			$table->string('carrier')->nullable();
			$table->string('trailer_type')->nullable();
			$table->string('temperature')->nullable();
			$table->string('plate_numbers')->nullable();
			$table->string('drivers_name')->nullable();
			$table->string('drivers_phone_number')->nullable();
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
        Schema::dropIfExists('transport_list');
    }
}
