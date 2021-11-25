<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecificationValues14Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification_values', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specification_values', 'numeric_value')){
                $table->float('numeric_value',8,2)->after('value')->nullable();
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
