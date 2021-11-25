<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappVerificationCodeToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users','whatsapp_verification_code')){
               $table->string('whatsapp_verification_code')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users','whatsapp_verification_code')){
               $table->dropColumn('whatsapp_verification_code');
            }
        });
    }
}
