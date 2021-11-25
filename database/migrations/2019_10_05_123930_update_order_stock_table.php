<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('offers', function (Blueprint $table) {
          if (Schema::hasColumn('offers', 'status'))
            $table->dropColumn('status');
      });
      Schema::table('offers', function (Blueprint $table) {
          if (!Schema::hasColumn('offers', 'status'))
            $table->enum('status', ['listed', 'instore', 'outstore'])->default('listed')->after('image');
      });

      Schema::table('orders', function (Blueprint $table) {
          if (Schema::hasColumn('orders', 'status'))
            $table->dropColumn('status');
      });
      Schema::table('orders', function (Blueprint $table) {
          if (!Schema::hasColumn('orders', 'min_price'))
            $table->double('min_price', 8, 2)->default(0)->after('price_range');
          if (!Schema::hasColumn('orders', 'max_price'))
            $table->double('max_price', 8, 2)->default(0)->after('min_price');
          if (!Schema::hasColumn('orders', 'total_prefs'))
            $table->integer('total_prefs')->default(0)->after('max_price');
          if (!Schema::hasColumn('orders', 'status'))
            $table->enum('status', ['listed', 'instore', 'outstore'])->default('listed')->after('total_prefs');
      });

      Schema::table('buyers', function (Blueprint $table) {
          if (!Schema::hasColumn('buyers', 'disc_upsc'))
            $table->string('disc_upsc')->after('purposes')->default(0);
          if (!Schema::hasColumn('buyers', 'total_prefs'))
            $table->string('total_prefs')->nullable()->after('disc_upsc');
          if (!Schema::hasColumn('buyers', 'note'))
            $table->text('note')->nullable()->after('total_prefs');
          if (!Schema::hasColumn('buyers', 'buyer2_contact'))
            $table->text('buyer2_contact')->nullable()->after('note');
          if (!Schema::hasColumn('buyers', 'transport_contact'))
            $table->text('transport_contact')->nullable()->after('buyer2_contact');
          if (!Schema::hasColumn('buyers', 'accounts_contact'))
            $table->text('accounts_contact')->nullable()->after('transport_contact');
          if (!Schema::hasColumn('buyers', 'vat'))
            $table->string('vat')->nullable()->after('company');
          if (!Schema::hasColumn('buyers', 'city'))
            $table->string('city')->nullable()->after('delivery_address');
          if (!Schema::hasColumn('buyers', 'postalcode'))
            $table->string('postalcode')->nullable()->after('city');
          if (!Schema::hasColumn('buyers', 'address'))
            $table->string('address')->nullable()->after('postalcode');
          if (!Schema::hasColumn('buyers', 'country'))
            $table->string('country')->nullable()->after('address');
          if (!Schema::hasColumn('buyers', 'delivery_same'))
            $table->enum('delivery_same', ['0', '1'])->default('1')->after('country');
          if (!Schema::hasColumn('buyers', 'product_prefs'))
            $table->enum('product_prefs', ['0', '1'])->default('0')->after('delivery_same');
          if (!Schema::hasColumn('buyers', 'variety_premium'))
            $table->string('variety_premium')->nullable()->after('product_prefs');
          if (!Schema::hasColumn('buyers', 'packaging'))
            $table->string('packaging')->nullable()->after('purposes');

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
