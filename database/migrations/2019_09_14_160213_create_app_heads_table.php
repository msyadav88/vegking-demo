<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->text('desc', 191)->nullable();
            $table->string('type', 191)->nullable();
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('app_heads');
    }
}
