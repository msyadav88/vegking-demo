<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pa_name')->nullable();
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->string('seo_tag_title')->nullable();
            $table->text('seo_tag_description')->nullable();
            $table->text('seo_tag_keywords')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('is_active', array('0', '1'))->default('1');
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
        Schema::dropIfExists('pages');
    }
}
