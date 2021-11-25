<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_header', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('header_en')->nullable();
            $table->string('header_de')->nullable();
            $table->string('header_pl')->nullable();
            $table->string('footer_en')->nullable();
            $table->string('footer_de')->nullable();
            $table->string('footer_pl')->nullable();
            $table->enum('status', array('1', '0'))->default('1');
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
        Schema::dropIfExists('template_header');
    }
}
