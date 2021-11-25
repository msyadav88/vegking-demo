<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuyercontactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyercontacts', function (Blueprint $table) {
            if(!Schema::hasColumn('buyercontacts','company')){
               $table->string('company')->nullable();
            }
            if(!Schema::hasColumn('buyercontacts','referral')){
               $table->string('referral')->nullable();
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
            if(Schema::hasColumn('buyercontacts','company')){
               $table->dropColumn('company');
            }
            if(Schema::hasColumn('buyercontacts','referral')){
               $table->dropColumn('referral');
            }
        });
    }
}
