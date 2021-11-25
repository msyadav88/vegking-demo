<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortcodeToProductSpecificationValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('product_specification_values', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specification_values', 'shortcode')){
                $table->string('shortcode')->nullable();
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
        Schema::table('product_specification_values', function (Blueprint $table) {
            //
        });
    }
}
