<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'variety')){
               $table->dropColumn('variety');
            }
            if (Schema::hasColumn('products', 'size_from')){
               $table->dropColumn('size_from');
            }
            if (Schema::hasColumn('products', 'size_to')){
               $table->dropColumn('size_to');
            }
            if (Schema::hasColumn('products', 'packing')){
               $table->dropColumn('packing');
            }
            if (Schema::hasColumn('products', 'quantity')){
               $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('products', 'flesh_color')){
               $table->dropColumn('flesh_color');
            }
            if (Schema::hasColumn('products', 'location')){
               $table->dropColumn('location');
            }
            if (Schema::hasColumn('products', 'price')){
               $table->dropColumn('price');
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
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
