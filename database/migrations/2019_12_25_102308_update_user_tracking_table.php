<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tracking', function (Blueprint $table) {
            if (!Schema::hasColumn('user_tracking', 'fromUrl')){
                $table->string('fromUrl')->nullable();
            }
            if (!Schema::hasColumn('user_tracking', 'toUrl')){
                $table->string('toUrl')->nullable();
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
