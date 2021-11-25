<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOffersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('offers', function (Blueprint $table) {
          if (Schema::hasColumn('offers', 'location'))
            $table->dropColumn('location');
          if (Schema::hasColumn('offers', 'packing'))
            $table->dropColumn('packing');
          if (!Schema::hasColumn('offers', 'city'))
            $table->bigInteger('city')->after('flesh_color')->default(0);
          if (!Schema::hasColumn('offers', 'postalcode'))
            $table->text('postalcode')->nullable()->after('city');
          if (!Schema::hasColumn('offers', 'street'))
            $table->text('street')->nullable()->after('postalcode');
          if (!Schema::hasColumn('offers', 'country'))
            $table->text('country')->nullable()->after('street');
          if (!Schema::hasColumn('offers', 'image'))
            $table->string('image')->nullable()->after('price');
          if (!Schema::hasColumn('offers', 'note'))
            $table->string('note')->nullable()->after('image');
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
