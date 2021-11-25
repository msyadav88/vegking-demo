<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappSmsNumberInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users','whatsapp_number')){
               $table->string('whatsapp_number')->nullable();
            }
            if(!Schema::hasColumn('users','sms_number')){
               $table->string('sms_number')->nullable();
            }
            if(!Schema::hasColumn('users','whatsapp_verified_at')){
               $table->dateTime('whatsapp_verified_at')->nullable();
            }
            if(!Schema::hasColumn('users','sms_verified_at')){
               $table->dateTime('sms_verified_at')->nullable();
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
            if(Schema::hasColumn('users','whatsapp_number')){
               $table->dropColumn('whatsapp_number');
            }
            if(Schema::hasColumn('users','sms_number')){
               $table->dropColumn('sms_number');
            }
            if(Schema::hasColumn('users','whatsapp_verified_at')){
               $table->dropColumn('whatsapp_verified_at');
            }
            if(Schema::hasColumn('users','sms_verified_at')){
               $table->dropColumn('sms_verified_at');
            }
        });
    }
}
