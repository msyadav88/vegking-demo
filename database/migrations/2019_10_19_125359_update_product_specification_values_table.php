<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecificationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('product_specification_values', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specification_values', 'premium')){
                $table->integer('premium')->nullable();
            }
			if (!Schema::hasColumn('product_specification_values', 'volume')){
                $table->integer('volume')->nullable();
            }
			if (!Schema::hasColumn('product_specification_values', 'default')){
                $table->enum('default', ['1', '0'])->nullable()->default(0);
            }
			if (!Schema::hasColumn('product_specification_values', 'status')){
                $table->enum('status', ['1', '0'])->nullable()->default(1);
            }
			if (!Schema::hasColumn('product_specification_values', 'extra_supply_cost')){
                $table->float('extra_supply_cost', 8, 2)->nullable()->default(null);
            }
            if (!Schema::hasColumn('product_specification_values', 'extra_cost_to_buyer_factor')){
                $table->float('extra_cost_to_buyer_factor', 8, 2)->nullable()->default(null);
            }
			if (!Schema::hasColumn('product_specification_values', 'description')){
                $table->text('description')->nullable();
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
