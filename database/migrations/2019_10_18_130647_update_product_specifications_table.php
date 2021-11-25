<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specifications', function (Blueprint $table) {
            if (Schema::hasColumn('product_specifications', 'default')){
               $table->dropColumn('default');
            }
            if (!Schema::hasColumn('product_specifications', 'parent_id')){
                $table->integer('parent_id')->nullable();
            }
			if (Schema::hasColumn('product_specifications', 'field')){
                $table->dropColumn('field');
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
