<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusPctToSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'status')){
                $table->enum('status', array('ordered', 'confirmed'))->default('ordered');
            }
            if (!Schema::hasColumn('sales', 'acceptedPct')){
                $table->integer('acceptedPct')->nullable();
            }
            if (!Schema::hasColumn('sales', 'rejectedPct')){
                $table->integer('rejectedPct')->nullable();
            }
            if (!Schema::hasColumn('sales', 'paidPct')){
                $table->integer('paidPct')->nullable();
            }
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
