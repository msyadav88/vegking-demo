<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_loads', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('salesid')->unsigned()->index();
			$table->bigInteger('transport_id')->unsigned()->index();
			$table->bigInteger('goods')->nullable();
			$table->bigInteger('variety')->unullable();
			$table->bigInteger('size_from')->nullable();
			$table->bigInteger('size_to')->nullable();
			$table->bigInteger('loaded_weight')->nullable();
			$table->bigInteger('unloaded_weight')->nullable();
			$table->bigInteger('difference')->nullable();
			$table->string('packaging_type')->nullable();
			$table->string('number_of_packing_units')->nullable();
			$table->string('requirements')->nullable();
			$table->string('freight_cost')->nullable();
			$table->string('payment_term')->nullable();
			$table->string('payment_type')->nullable();
			$table->string('transport_invoice_no')->nullable();
			$table->string('transport_invoice_due_date')->nullable();
			$table->string('payment_status')->nullable();
			$table->string('notes_from_accounting')->nullable();
			$table->string('documents')->nullable();
			$table->string('notes')->nullable();
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
        Schema::dropIfExists('trans_loads');
    }
}
