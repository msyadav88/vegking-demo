<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->integer('amount')->default(0);
            $table->integer('paid')->default(0);
            $table->enum('status', array('PAID', 'UNPAID'))->default('UNPAID');
            $table->bigInteger('buyer_id')->unsigned()->index();
            $table->bigInteger('seller_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('quantity_type')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('gross')->default(0);
            $table->integer('net')->default(0);
            $table->integer('vat')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
