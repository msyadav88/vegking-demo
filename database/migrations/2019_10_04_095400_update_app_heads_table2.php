<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAppHeadsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_heads', function (Blueprint $table) {
            if (!Schema::hasColumn('app_heads', 'color_id'))
                $table->integer('color_id')->nullable();
            if (!Schema::hasColumn('app_heads', 'tuber_shape'))
                $table->string('tuber_shape',191)->nullable();
            if (!Schema::hasColumn('app_heads', 'dry_matter'))
                $table->float('dry_matter')->nullable();
            if (!Schema::hasColumn('app_heads', 'colour_of_skin'))
                $table->string('colour_of_skin',191)->nullable();
            if (!Schema::hasColumn('app_heads', 'depth_of_eyes'))
                $table->string('depth_of_eyes',191)->nullable();
            if (!Schema::hasColumn('app_heads', 'smoothness_of_skin'))
                $table->string('smoothness_of_skin',191)->nullable();
            if (!Schema::hasColumn('app_heads', 'premium'))
                $table->integer('premium')->nullable()->default(0);
            if (!Schema::hasColumn('app_heads', 'default'))
                $table->enum('default', ['1', '0'])->nullable()->default(0);
            if (!Schema::hasColumn('app_heads', 'order'))
                $table->integer('order')->nullable()->default(0);
            if (!Schema::hasColumn('app_heads', 'parent'))
                $table->string('parent',191)->nullable();
            if (!Schema::hasColumn('app_heads', 'image'))
                $table->string('image',191)->nullable();
            if (!Schema::hasColumn('app_heads', 'base_price'))
                $table->float('base_price',15,2)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_heads', function (Blueprint $table) {
            //
        });
    }
}
