<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecificationsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('product_specifications', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specifications', 'type_name')){
                 $table->string('type_name')->after('product_id')->nullable();
            }
            if (!Schema::hasColumn('product_specifications', 'order_for_seller')){
                 $table->integer('order_for_seller')->nullable();
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
         Schema::dropIfExists('product_specifications');
    }
}
