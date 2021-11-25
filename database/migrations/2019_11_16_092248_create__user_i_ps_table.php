<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserIPsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userIps', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('UserId')->nullable();
            $table->string('IP')->nullable();
            $table->enum('didLogin', array('yes', 'No'))->default('No');
            $table->string('Date')->nullable(); 
            $table->string('Time')->nullable(); 
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
        Schema::dropIfExists('userIps');
    }
}
