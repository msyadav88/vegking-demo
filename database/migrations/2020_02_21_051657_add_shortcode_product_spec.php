<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortcodeProductSpec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('product_specifications', function (Blueprint $table) {
            if (!Schema::hasColumn('product_specifications', 'shortcode')){
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
        Schema::table('product_specifications', function (Blueprint $table) {
            //
        });
    }
}
