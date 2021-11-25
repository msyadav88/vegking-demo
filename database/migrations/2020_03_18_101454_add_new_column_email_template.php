<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnEmailTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_templates', function (Blueprint $table) {
            if (!Schema::hasColumn('email_templates', 'push_sounds')){
                $table->Integer('push_sounds')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_templates', function (Blueprint $table) {
            if(Schema::hasColumn('push_sounds')){
               $table->dropColumn('push_sounds');
            }
        });
    }
}
