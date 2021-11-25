<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->index();
            $table->string('cash')->nullable();
            $table->string('wire')->nullable();
            $table->string('amount')->nullable();
            $table->date('due_date')->nullable();
            $table->string('type')->nullable();
            $table->string('purchase')->nullable();
            $table->date('date')->nullable();
            $table->enum('paid', array('0', '1'))->default('0');
            $table->date('date_paid')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
