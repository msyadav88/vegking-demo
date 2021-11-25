<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmailTemplatesTable5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_templates', function (Blueprint $table) {
            if (!Schema::hasColumn('email_templates', 'header_en')){
                $table->string('header_en')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'header_de')){
                $table->text('header_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'header_pl')){
                $table->text('header_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'footer_en')){
                $table->text('footer_en')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'footer_de')){
                $table->text('footer_de')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'footer_pl')){
                $table->text('footer_pl')->nullable();
            }
            if (!Schema::hasColumn('email_templates', 'global_header')){
                $table->enum('global_header', array('1', '0'))->default('0');
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
