<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
			$table->integer('buyer_id')->default(0);
			$table->integer('match_id')->default(0);
			$table->integer('stock_id')->default(0);
			$table->integer('quantity')->default(0);
			$table->date('sale_date')->nullable();
			$table->date('delivery_date')->nullable();
			$table->integer('payment_term')->nullable();
			$table->integer('payment_type')->nullable();
			$table->integer('payment_currency')->nullable();
			$table->enum('payment_status', ['Paid', 'Unpaid'])->default('Unpaid');
            $table->dropColumn('offer_id');
           // $table->dropColumn('request_id');
           // $table->dropColumn('status');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
}
