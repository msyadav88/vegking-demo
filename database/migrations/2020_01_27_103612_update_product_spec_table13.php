<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecTable13 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification_values', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specification_values', 'related_spec_id')){
                $table->integer('related_spec_id')->nullable();
            }
            if (!Schema::hasColumn('product_specification_values', 'related_spec_val_id')){
                $table->integer('related_spec_val_id')->nullable();
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
        //
    }
}
