<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductSpecificationIdInMatchItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_items', function (Blueprint $table) {
            if(!Schema::hasColumn('match_items','product_specification_id')){
               $table->integer('product_specification_id')->nullable()->after('match_id');
            }
            if(Schema::hasColumn('match_items','name')){
               $table->dropColumn('name');
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
        Schema::table('match_items', function (Blueprint $table) {
            if(Schema::hasColumn('match_items','product_specification_id')){
               $table->dropColumn('product_specification_id');
            }
        });
    }
}
