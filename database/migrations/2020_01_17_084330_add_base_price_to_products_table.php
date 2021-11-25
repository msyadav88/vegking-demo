<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBasePriceToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if(!Schema::hasColumn('products','base_price')){
               $table->string('base_price')->nullable()->comment('average sale price used in pton');
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
            if(Schema::hasColumn('products','base_price')){
               $table->dropColumn('base_price');
            }
        });
    }
}
