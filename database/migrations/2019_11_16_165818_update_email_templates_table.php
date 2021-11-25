<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('email_templates', function (Blueprint $table) {
          if (!Schema::hasColumn('email_templates', 'email_content_pl')){
              $table->text('email_content_pl')->nullable()->after('email_content');
          }
          if (!Schema::hasColumn('email_templates', 'sms_content_pl')){
              $table->text('sms_content_pl')->nullable()->after('sms_content');
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
        //
    }
}
