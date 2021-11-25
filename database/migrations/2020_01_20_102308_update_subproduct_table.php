<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class UpdateSubProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (Schema::hasColumn('sub_product', 'date_added'))
        {
            Schema::table('sub_product', function (Blueprint $table) {
                $table->dropColumn('date_added');
                $table->dropColumn('date_updated');
            });
        }
        if (!Schema::hasColumn('sub_product', 'sub_pro_type')){
            Schema::table('sub_product', function (Blueprint $table) {
                $table->text('sub_pro_type')->nullable()->after('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        
    }
}
