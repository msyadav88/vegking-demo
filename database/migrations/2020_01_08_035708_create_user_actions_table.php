<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trader_id')->nullable();
            $table->integer('stock_id')->nullable();
            $table->text('user_action')->nullable();
            $table->text('entity')->nullable();
            $table->integer('entity_id')->nullable();
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
        Schema::dropIfExists('user_actions');
    }
}
