<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStatusInOrder2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order2', function (Blueprint $table) {
            if (!Schema::hasColumn('order2', 'payment_status')){
               $table->enum('payment_status',['Paid','Unpaid'])->default('Unpaid');
            };
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order2', function (Blueprint $table) {
            $table->dropColoumn('payment_status');
        });
    }
}
