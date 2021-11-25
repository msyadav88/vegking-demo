<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUploadedfilesToTransLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trans_loads', function (Blueprint $table) {
            if (!Schema::hasColumn('trans_loads', 'uploadedfiles')){
                $table->string('uploadedfiles')->nullable();
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
        Schema::table('trans_loads', function (Blueprint $table) {
             $table->dropColumn('uploadedfiles');
        });
    }
}
