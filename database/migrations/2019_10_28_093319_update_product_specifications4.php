<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecifications4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specifications', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specifications', 'field_type')){
                $table->string('field_type')->nullable();
            }
            if (!Schema::hasColumn('product_specifications', 'buyer_pref_anylogic')){
                $table->enum('buyer_pref_anylogic', array('Yes', 'No'))->default('No');
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
