<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class UpdateAffiliateData extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('affiliate_data', function (Blueprint $table) {
			if (!Schema::hasColumn('affiliate_data', 'u_id')){
				$table->bigInteger('u_id')->unsigned()->index()->after('id');
				$table->foreign('u_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			}	
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        
    }
}
