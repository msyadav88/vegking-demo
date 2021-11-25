<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->mediumInteger('post_code')->nullable();
            $table->ipAddress('ip');
            $table->string('refer_link', 255)->nullable();
            $table->string('city')->nullable();
            $table->boolean('did_logn')->nullable();
            $table->string('country')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
