<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerPrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_prefs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buyer_id');
            $table->string('type',191)->nullable();
            $table->string('key',191)->nullable();
            $table->string('val',191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buyer_prefs');
    }
}
