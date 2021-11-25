<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecificationsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specifications', function (Blueprint $table) {
            if (Schema::hasColumn('product_specifications', 'hasmany')){
                $table->dropColumn('hasmany');
            }
            if (Schema::hasColumn('product_specifications', 'field')){
                $table->dropColumn('field');
            }
            if (!Schema::hasColumn('product_specifications', 'buyer_hasmany')){
                $table->enum('buyer_hasmany', array('Yes', 'No'))->default('No');
            }
            if (!Schema::hasColumn('product_specifications', 'stock_hasmany')){
                $table->enum('stock_hasmany', array('Yes', 'No'))->default('No');
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
        Schema::table('product_specifications', function (Blueprint $table) {
            //
        });
    }
}
