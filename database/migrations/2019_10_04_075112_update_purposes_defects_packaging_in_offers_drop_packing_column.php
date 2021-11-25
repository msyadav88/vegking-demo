<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePurposesDefectsPackagingInOffersDropPackingColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            if( Schema::hasColumn( 'offers', 'packing')){
                $table->dropColumn('packing');
            }
            Schema::table('offers', function (Blueprint $table) {
                if (!Schema::hasColumn('offers', 'purposes'))
                    $table->text('purposes')->nullable();
                if (!Schema::hasColumn('offers', 'defects'))
                    $table->text('defects')->nullable();
                if (!Schema::hasColumn('offers', 'packaging'))
                    $table->text('packaging')->nullable();
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers_drop_packaging_column', function (Blueprint $table) {
            //
        });
    }
}
