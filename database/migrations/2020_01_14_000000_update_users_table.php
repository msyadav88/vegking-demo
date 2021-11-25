<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			if (!Schema::hasColumn('users', 'user_code')){
				$table->text('user_code')->nullable()->after('phone');
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
