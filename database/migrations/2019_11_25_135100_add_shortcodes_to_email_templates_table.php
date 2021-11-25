<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortcodesToEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_templates', function (Blueprint $table) {
            if(!Schema::hasColumn('email_templates','shortcodes')){
               $table->string('shortcodes')->nullable();
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
            if(Schema::hasColumn('email_templates','shortcodes')){
               $table->dropColumn('shortcodes');
            }
        });
    }
}
