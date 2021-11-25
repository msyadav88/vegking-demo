<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEcEcbfInProductSpecificationValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specification_values', function (Blueprint $table) {
            if(!Schema::hasColumn('product_specification_values','ec')){
               $table->string('ec')->nullable();
            }
            if(!Schema::hasColumn('product_specification_values','ecbf')){
               $table->string('ecbf')->nullable();
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
            if(Schema::hasColumn('product_specification_values','ec')){
               $table->dropColumn('ec');
            }
            if(Schema::hasColumn('product_specification_values','ecbf')){
               $table->dropColumn('ecbf');
            }
        });
    }
}
