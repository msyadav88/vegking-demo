<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('company')->nullable();
            $table->text('delivery_address')->nullable();
            $table->float('credit_limit')->nullable();
            $table->string('product')->nullable();
            $table->string('variety')->nullable();
            $table->string('packing')->nullable();
            $table->string('dry_matter_content')->nullable();
            $table->string('transportation')->nullable();
            $table->string('price_prefs')->nullable();
            $table->text('size_range')->nullable();
            $table->string('soil')->nullable();
            $table->string('flesh_color')->nullable();
            $table->text('purposes')->nullable();
            $table->text('defects')->nullable();
            $table->enum('status', array('0', '1'))->default('1');
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
        Schema::dropIfExists('buyers');
    }
}
