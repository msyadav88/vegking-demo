<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailconfirmOffersent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offersent', function (Blueprint $table) {
            if (!Schema::hasColumn('offersent', 'email_confirm')) {
                $table->tinyInteger('email_confirm')->nullable();
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
        Schema::table('offersent', function (Blueprint $table) {
            if(Schema::hasColumn('email_confirm')){
               $table->dropColumn('email_confirm');
            }
        });
    }
}
