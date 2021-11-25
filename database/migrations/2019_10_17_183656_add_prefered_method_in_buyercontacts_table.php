<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreferedMethodInBuyercontactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyercontacts', function (Blueprint $table) {
            if(!Schema::hasColumn('buyercontacts','prefered_method')){
               $table->string('prefered_method')->nullable();
            }
            if(!Schema::hasColumn('buyercontacts','notes')){
               $table->text('notes')->nullable();
            }
            if(!Schema::hasColumn('buyercontacts','email_verified_at')){
               $table->timestamp('email_verified_at')->nullable();
            }
            if(!Schema::hasColumn('buyercontacts','email_verification_code')){
               $table->string('email_verification_code')->nullable();
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
        Schema::table('buyercontacts', function (Blueprint $table) {
            if(Schema::hasColumn('buyercontacts','prefered_method')){
               $table->dropColumn('prefered_method');
            }
            if(Schema::hasColumn('buyercontacts','notes')){
               $table->dropColumn('notes');
            }             
            if(Schema::hasColumn('buyercontacts','email_verified_at')){
               $table->dropColumn('email_verified_at');
            }             
             if(Schema::hasColumn('buyercontacts','email_verification_code')){
               $table->dropColumn('email_verification_code');
            }             
        });
    }
}
