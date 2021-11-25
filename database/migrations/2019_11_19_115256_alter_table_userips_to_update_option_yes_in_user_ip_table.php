<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUseripsToUpdateOptionYesInUserIpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userips', function (Blueprint $table) {
            if(Schema::hasColumn('userips','didLogin')){
               DB::statement("ALTER TABLE userips MODIFY COLUMN didLogin ENUM('Yes', 'No')");
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
        Schema::table('userips', function (Blueprint $table) {
            if(Schema::hasColumn('userips','didLogin')){
               DB::statement("ALTER TABLE userips MODIFY COLUMN didLogin ENUM('yes', 'No')");
            }
        });
    }
}
