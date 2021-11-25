<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',45)->nullable();
            $table->string('code',45)->nullable();
            $table->string('ph_code',45)->nullable();
            $table->string('postal_code',191)->nullable();
            $table->string('postal_code_short',191)->nullable();
            $table->string('country',191)->nullable();
            $table->float('price',15,2)->nullable();
            $table->enum('type', ['country', 'city'])->nullable()->default('city');
            $table->enum('status', ['0', '1'])->default('1');
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
        Schema::dropIfExists('postal_codes');
    }
}
