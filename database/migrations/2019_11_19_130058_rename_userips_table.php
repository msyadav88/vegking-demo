<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUseripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('userIps');
        Schema::create('userips', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('userid')->nullable();
            $table->string('ip')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->enum('didlogin', array('Yes', 'No'))->default('No');
            $table->string('date')->nullable(); 
            $table->string('time')->nullable(); 
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
        Schema::dropIfExists('userips');
    }
}
