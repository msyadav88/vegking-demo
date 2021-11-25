<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmailtemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_templates', function (Blueprint $table) {
            $table->text('push_content_de')->nullable();
            $table->text('push_content_pl')->nullable();
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
            if(Schema::hasColumn('push_content_de')){
               $table->dropColumn('push_content_de');
            }
            if(Schema::hasColumn('push_content_pl')){
                $table->dropColumn('push_content_pl');
             }
        });
    }
}
