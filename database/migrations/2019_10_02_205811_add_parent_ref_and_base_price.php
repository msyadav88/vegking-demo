<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentRefAndBasePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_heads', function (Blueprint $table) {
            if (!Schema::hasColumn('app_heads', 'parent_ref'))
                $table->string('parent_ref')->nullable();
            if (!Schema::hasColumn('app_heads', 'base_price'))
                $table->string('base_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_heads', function (Blueprint $table) {
            //
        });
    }
}
