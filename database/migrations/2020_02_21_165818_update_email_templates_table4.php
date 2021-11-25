<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmailTemplatesTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_templates', function (Blueprint $table) {
            if (!Schema::hasColumn('email_templates', 'buyer_subject')){
                $table->string('buyer_subject')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_email_content')){
                $table->text('buyer_email_content')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_email_content_de')){
                $table->text('buyer_email_content_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_email_content_pl')){
                $table->text('buyer_email_content_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_sms_content')){
                $table->text('buyer_sms_content')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_sms_content_de')){
                $table->text('buyer_sms_content_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_sms_content_pl')){
                $table->text('buyer_sms_content_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_push_content')){
                $table->text('buyer_push_content')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_push_content_de')){
                $table->text('buyer_push_content_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_push_content_pl')){
                $table->text('buyer_push_content_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'buyer_status')){
                $table->enum('buyer_status', array('1', '0'))->default('1');
            }
            if (!Schema::hasColumn('email_templates', 'trader_subject')){
                $table->string('trader_subject')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_email_content')){
                $table->text('trader_email_content')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_email_content_de')){
                $table->text('trader_email_content_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_email_content_pl')){
                $table->text('trader_email_content_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_sms_content')){
                $table->text('trader_sms_content')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_sms_content_de')){
                $table->text('trader_sms_content_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_sms_content_pl')){
                $table->text('trader_sms_content_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_push_content')){
                $table->text('trader_push_content')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_push_content_de')){
                $table->text('trader_push_content_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_push_content_pl')){
                $table->text('trader_push_content_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'trader_status')){
                $table->enum('trader_status', array('1', '0'))->default('1');
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
        Schema::dropIfExists('email_templates');
    }
}
