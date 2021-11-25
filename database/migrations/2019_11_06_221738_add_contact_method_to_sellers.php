<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactMethodToSellers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            if(!Schema::hasColumn('sellers','contact_email')){
               $table->boolean('contact_email')->nullable();
            }
            if(!Schema::hasColumn('sellers','contact_sms')){
               $table->boolean('contact_sms')->nullable();
            }
            if(!Schema::hasColumn('sellers','contact_whatsapp')){
               $table->boolean('contact_whatsapp')->nullable();
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
        Schema::table('sellers', function (Blueprint $table) {
            if(Schema::hasColumn('sellers','contact_email')){
               $table->dropColumn('contact_email');
            }
            if(Schema::hasColumn('sellers','contact_sms')){
               $table->dropColumn('contact_sms');
            }
            if(Schema::hasColumn('sellers','contact_whatsapp')){
               $table->dropColumn('contact_whatsapp');
            }
        });
    }
}
