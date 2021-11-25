<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuyersTable5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            if( !Schema::hasColumn('buyers','contact_email') ){
                $table->integer("contact_email")->default(0);
            }
            if( !Schema::hasColumn('buyers','contact_sms') ){
                $table->integer("contact_sms")->default(0);
            }
            if( !Schema::hasColumn('buyers','contact_whatsapp') ){
                $table->integer("contact_whatsapp")->default(0);
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
        Schema::table('buyers', function (Blueprint $table) {
            //
        });
    }
}
