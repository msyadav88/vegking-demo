<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('match_id')->nullable();
            $table->string('name')->nullable();
            $table->string('value',255)->nullable();
            $table->boolean('matched')->nullable();
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
        Schema::dropIfExists('match_items');
    }
}
