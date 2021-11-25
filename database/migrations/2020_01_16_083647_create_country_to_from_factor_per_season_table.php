<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryToFromFactorPerSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_to_from_factor_per_season', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('fromTo')->nullable();
            $table->string('season')->nullable();
            $table->string('factor')->nullable();           
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
        Schema::dropIfExists('country_to_from_factor_per_season');
    }
}
