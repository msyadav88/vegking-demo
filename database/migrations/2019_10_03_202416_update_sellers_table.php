<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('sellers', function (Blueprint $table) {
          $table->bigInteger('user_id')->after('id')->default(0);
          $table->text('seller2_contact')->nullable()->after('phone');
          $table->text('transport_contact')->nullable()->after('seller2_contact');
          $table->text('accounts_contact')->nullable()->after('transport_contact');
          $table->string('vat')->nullable()->after('company');
          $table->string('city')->nullable()->after('vat');
          $table->string('postalcode')->nullable()->after('city');
          $table->string('address')->nullable()->after('postalcode');
          $table->string('country')->nullable()->after('address');
          $table->string('note')->nullable()->after('country');
          $table->integer('available_stocks')->nullable()->after('note');
          $table->enum('invite_sent', array('0', '1'))->default('0')->after('available_stocks');
          $table->enum('verified', array('0', '1'))->default('0')->after('invite_sent');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('user_id');
          $table->dropColumn('seller2_contact');
          $table->dropColumn('transport_contact');
          $table->dropColumn('accounts_contact');
          $table->dropColumn('vat');
          $table->dropColumn('city');
          $table->dropColumn('postalcode');
          $table->dropColumn('address');
          $table->dropColumn('country');
          $table->dropColumn('note');
          $table->dropColumn('available_stocks');
          $table->dropColumn('invite_sent');
          $table->dropColumn('verified');
      });
    }
}
